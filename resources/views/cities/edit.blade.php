@extends('layouts.app')

@section('content')
<h2>Edit City</h2>

<form method="POST" action="{{ route('admin.cities.update', $city) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Country</label>
        <select name="country_id" class="form-select">
            @foreach($countries as $country)
                <option value="{{ $country->id }}" @selected(old('country_id', $city->country_id) == $country->id)>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">City Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $city->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Cost of Living</label>
        <select name="cost_of_living" class="form-select">
            <option value="Low" @selected(old('cost_of_living', $city->cost_of_living) == 'Low')>Low</option>
            <option value="Medium" @selected(old('cost_of_living', $city->cost_of_living) == 'Medium')>Medium</option>
            <option value="High" @selected(old('cost_of_living', $city->cost_of_living) == 'High')>High</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Climate</label>
        <input type="text" name="climate" class="form-control" value="{{ old('climate', $city->climate) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Safety Level (1-5)</label>
        <input type="number" name="safety_level" min="1" max="5" class="form-control" value="{{ old('safety_level', $city->safety_level) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Transport System</label>
        <input type="text" name="transport_system" class="form-control" value="{{ old('transport_system', $city->transport_system) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Part-time Work Available?</label>
        <select name="part_time_work" class="form-select">
            <option value="1" @selected(old('part_time_work', $city->part_time_work) == 1)>Yes</option>
            <option value="0" @selected(old('part_time_work', $city->part_time_work) == 0)>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection