<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'housing_type',
        'monthly_budget',
        'cultural_challenges',
        'academic_environment',
        'part_time_job_experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function getVoteScoreAttribute()
    {
        return $this->votes()->sum('vote');
    }
}
