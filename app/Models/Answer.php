<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model{
    protected $fillable = ['question_id','user_id','body','is_most_helpful',];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    //s4
    public function reports(){ return $this->morphMany(Report::class, 'reportable');}
}
