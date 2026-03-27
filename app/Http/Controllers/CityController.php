<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->latest()->get();
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string',
            'cost_of_living' => 'required|string',
            'climate' => 'required|string',
            'safety_level' => 'required|integer|min:1|max:5',
            'transport_system' => 'required|string',
            'part_time_work' => 'required|boolean',
        ]);

        City::create($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'City added successfully.');
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string',
            'cost_of_living' => 'required|string',
            'climate' => 'required|string',
            'safety_level' => 'required|integer|min:1|max:5',
            'transport_system' => 'required|string',
            'part_time_work' => 'required|boolean',
        ]);

        $city->update($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }

    public function publicIndex(Request $request)
    {
        $countries = Country::all();

        $cities = City::with('country')
            ->when($request->country_id, fn($q) => $q->where('country_id', $request->country_id))
            ->when($request->cost_of_living, fn($q) => $q->where('cost_of_living', $request->cost_of_living))
            ->when($request->safety_level, fn($q) => $q->where('safety_level', '>=', $request->safety_level))
            ->latest()
            ->get();

        return view('cities.public-index', compact('cities', 'countries'));
    }

    public function show(City $city)
    {
        $city->load(['country', 'experiences.user', 'questions.user']);
        return view('cities.show', compact('city'));
    }
}