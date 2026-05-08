<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// SPRINT NOTE: Stores a single user's star rating for a city
class CityRating extends Model {
    protected $fillable = ['user_id', 'city_id', 'rating'];
    public function user(){ return $this->belongsTo(User::class);}
    public function city() { return $this->belongsTo(City::class);}
}
