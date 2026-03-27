<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'description'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
