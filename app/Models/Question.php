<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id','country_id','city_id','title','body'];
    protected $appends = ['upvotes_count','downvotes_count','vote_score',];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function votes(){
        return $this->morphMany(Vote::class, 'votable');
    }

    public function getUpvotesCountAttribute(){
        return $this->votes()->where('vote', 1)->count();
    }

    public function getDownvotesCountAttribute(){
        return $this->votes()->where('vote', -1)->count();
    }

    public function getVoteScoreAttribute(){
        return $this->votes()->sum('vote');
    }

    public function userVote(){
        if (!auth()->check()) return null;
        return $this->votes()->where('user_id', auth()->user()?->id)->value('vote');
    }

    //s4
    public function reports(){ return $this->morphMany(Report::class, 'reportable');}
}
