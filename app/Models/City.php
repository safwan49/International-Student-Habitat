<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class City extends Model{
    protected $fillable = ['country_id','name','cost_of_living','climate','safety_level','transport_system','part_time_work'];

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
    public function ratings()
{
    return $this->hasMany(CityRating::class);
}

/*S4 Cityrating helpers*/

//avg submitted ratings
public function averageRating(): float {
    return round($this->ratings()->avg('rating') ?? 0, 1);
}

//user's given city rating
public function userRating(): ?int{
    if(!auth()->check()) return null;
    return $this->ratings()->where('user_id', auth()->id())->value('rating');
}
}
