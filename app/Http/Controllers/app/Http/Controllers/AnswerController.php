<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function markMostHelpful($questionId, $answerId, Request $request)
    {
        $question = Question::findOrFail($questionId);

        // Only question owner can mark
        if ($question->user_id != $request->user()->id) {
            return response()->json(['message' => 'Not allowed'], 403);
        }

        // Reset previous most helpful
        Answer::where('question_id', $questionId)
            ->update(['is_most_helpful' => false]);

        // Mark selected answer
        $answer = Answer::where('id', $answerId)
            ->where('question_id', $questionId)
            ->firstOrFail();

        $answer->is_most_helpful = true;
        $answer->save();

        return response()->json(['message' => 'Marked as most helpful']);
    }
}
