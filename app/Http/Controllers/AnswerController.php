<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Answer::create([
            'question_id' => $question->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Answer submitted.');
    }
    public function markMostHelpful(Question $question, Answer $answer)
    {
        abort_if($question->user_id !== auth()->id(), 403);
        abort_if($answer->question_id !== $question->id, 404);

        $question->answers()->update(['is_most_helpful' => false]);

        $answer->update(['is_most_helpful' => true]);

        return back()->with('success', 'Most helpful answer selected.');
    }
}