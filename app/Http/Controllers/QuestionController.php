<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'recent');

        $questions = Question::with(['user', 'country', 'city', 'answers'])
            ->withCount('answers')
            ->withSum('votes as vote_score_sum', 'vote')
            ->when(
                $sort === 'helpful',
                fn($q) => $q->orderByDesc('vote_score_sum')->latest(),
                fn($q) => $q->latest()
            )
            ->get();

        $countries = Country::all();
        $cities = City::with('country')->get();

        return view('questions.index', compact('questions', 'countries', 'cities', 'sort'));
    }

    public function create()
    {
        $countries = Country::all();
        $cities = City::all();

        return view('questions.create', compact('countries', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Question::create([
            'user_id' => auth()->user()?->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question posted successfully.');
    }

    public function show(Request $request, Question $question)
    {
        $answerSort = $request->get('answer_sort', 'recent');

        $question->load([
            'user',
            'country',
            'city',
        ]);

        $answers = $question->answers()
            ->with('user')
            ->when(
                $answerSort === 'helpful',
                fn($q) => $q->orderByDesc('is_most_helpful')->latest(),
                fn($q) => $q->latest()
            )
            ->get();

        $question->setRelation('answers', $answers);

        return view('questions.show', compact('question', 'answerSort'));
    }

    public function edit(Question $question)
    {
        abort_if($question->user_id !== auth()->user()?->id, 403);

        $countries = Country::all();
        $cities = City::all();

        return view('questions.edit', compact('question', 'countries', 'cities'));
    }

    public function update(Request $request, Question $question)
    {
        abort_if($question->user_id !== auth()->user()?->id, 403);

        $request->validate([
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $question->update([
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('questions.show', $question)->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        abort_if($question->user_id !== auth()->user()?->id, 403);

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}