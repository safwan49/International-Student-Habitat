<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller{
    public function index(){
        $experiences = Experience::with(['city', 'user'])->latest()->get();
        return view('experiences.index', compact('experiences'));
    }

    public function create(){
        $cities = City::with('country')->get();
            return view('experiences.create', compact('cities'));
    }

    public function store(Request $request){
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'housing_type' => 'required|string',
            'monthly_budget' => 'required|numeric',
            'cultural_challenges' => 'required|string',
            'academic_environment' => 'required|string',
            'part_time_job_experience' => 'nullable|string']);

        Experience::create([
            'user_id' => auth()->id(),
            ...$request->only([
                'city_id',
                'housing_type',
                'monthly_budget',
                'cultural_challenges',
                'academic_environment',
                'part_time_job_experience'])
        ]);
        //s4 +3 for city exp
        auth()->user()->increment('reputation_points',3);
        //
        return redirect()->route('experiences.index')->with('success','Experience submitted.');
    }

    public function edit(Experience $experience){
        abort_if($experience->user_id !== auth()->user()?->id, 403);
        $cities = City::with('country')->get();
        return view('experiences.edit', compact('experience', 'cities'));
    }

    public function update(Request $request, Experience $experience){
        abort_if($experience->user_id !== auth()->id(), 403);

        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'housing_type' => 'required|string',
            'monthly_budget' => 'required|numeric',
            'cultural_challenges' => 'required|string',
            'academic_environment' => 'required|string',
            'part_time_job_experience' => 'nullable|string',
        ]);

        $experience->update($request->only([
            'city_id',
            'housing_type',
            'monthly_budget',
            'cultural_challenges',
            'academic_environment',
            'part_time_job_experience',
        ]));
        return redirect()->route('experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience){
        abort_if($experience->user_id !== auth()->id(), 403);
        $experience->delete();
        return redirect()->route('experiences.index')->with('success', 'Experience deleted.');
    }

}