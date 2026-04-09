<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, $type, $id)
    {
        $request->validate([
            'vote' => 'required|in:1,-1',
        ]);

        $model = match ($type) {
            'question' => Question::findOrFail($id),
            'experience' => Experience::findOrFail($id),
            default => abort(404),
        };

        Vote::updateOrCreate(
            [
                'user_id' => auth()->user()?->id,
                'votable_id' => $model->id,
                'votable_type' => get_class($model),
            ],
            [
                'vote' => (int) $request->vote,
            ]
        );

        return back()->with('success', 'Your vote has been saved.');
    }
}
