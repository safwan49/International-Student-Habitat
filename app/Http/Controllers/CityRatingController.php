<?php
namespace App\Http\Controllers;
use App\Models\City;
use App\Models\CityRating;
use Illuminate\Http\Request;

// City rating submission
class CityRatingController extends Controller {
    public function store(Request $request, City $city) {
        $request->validate(['rating'=>'required|integer|min:1|max:5']);

        // updates existing rating or create a new one
        CityRating::updateOrCreate( ['user_id' => auth()->id(),'city_id' => $city->id],['rating' => $request->rating]);
        return back()->with('success', 'Your rating has been saved.');
    }
}
