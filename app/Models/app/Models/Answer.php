<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'user_id',
        'content',
        'is_most_helpful'
    ];
}
