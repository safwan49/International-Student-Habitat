@extends('layouts.app')

@section('content')
<h2>Add Experience</h2>

<form method="POST" action="{{ route('experiences.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">City</label>
        <select name="city_id" class="form-select">
            <option value="">Select City</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>
                    {{ $city->name }} ({{ $city->country->name }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Housing Type</label>
        <input type="text" name="housing_type" class="form-control" value="{{ old('housing_type') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Monthly Budget</label>
        <input type="number" step="0.01" name="monthly_budget" class="form-control" value="{{ old('monthly_budget') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Cultural Challenges</label>
        <textarea name="cultural_challenges" class="form-control" rows="4">{{ old('cultural_challenges') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Academic Environment</label>
        <textarea name="academic_environment" class="form-control" rows="4">{{ old('academic_environment') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Part-time Job Experience</label>
        <textarea name="part_time_job_experience" class="form-control" rows="4">{{ old('part_time_job_experience') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection