<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'cost_of_living',
        'climate',
        'safety_level',
        'transport_system',
        'part_time_work',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
