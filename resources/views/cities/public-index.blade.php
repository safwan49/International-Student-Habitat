@extends('layouts.app')

@section('content')
<h2 class="mb-4">Browse Cities</h2>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <select name="country_id" class="form-select">
            <option value="">All Countries</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" @selected(request('country_id') == $country->id)>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="cost_of_living" class="form-select">
            <option value="">Cost Level</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="safety_level" class="form-select">
            <option value="">Minimum Safety</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
</form>

<div class="row">
    @foreach($cities as $city)
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $city->name }}</h5>
                    <p><strong>Country:</strong> {{ $city->country->name }}</p>
                    <p><strong>Cost:</strong> {{ $city->cost_of_living }}</p>
                    <p><strong>Climate:</strong> {{ $city->climate }}</p>
                    <p><strong>Safety:</strong> {{ $city->safety_level }}/5</p>
                    <a href="{{ route('cities.show', $city) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection