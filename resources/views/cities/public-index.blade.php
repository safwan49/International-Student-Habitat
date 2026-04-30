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

    <div class="col-md-4">
        <select name="cost_of_living" class="form-select">
            <option value="">Any Cost Level</option>
            @foreach($costLevels as $level)
                <option value="{{ $level }}" @selected(request('cost_of_living') == $level)>
                    {{ $level }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select name="climate" class="form-select">
            <option value="">Any Climate</option>
            @foreach($climates as $climate)
                <option value="{{ $climate }}" @selected(request('climate') == $climate)>
                    {{ $climate }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select name="safety_level" class="form-select">
            <option value="">Minimum Safety</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" @selected(request('safety_level') == $i)>
                    {{ $i }}+
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-4">
        <select name="transport_system" class="form-select">
            <option value="">Any Transport System</option>
            @foreach($transportSystems as $transport)
                <option value="{{ $transport }}" @selected(request('transport_system') == $transport)>
                    {{ $transport }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select name="part_time_work" class="form-select">
            <option value="">Part-time Work Availability</option>
            <option value="1" @selected(request('part_time_work') === '1')>Available</option>
            <option value="0" @selected(request('part_time_work') === '0')>Not Available</option>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

    <div class="col-md-3">
        <a href="{{ route('cities.public') }}" class="btn btn-outline-secondary w-100">Reset</a>
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
                    <p><strong>Transport:</strong> {{ $city->transport_system }}</p>
                    <p><strong>Part-time work:</strong> {{ $city->part_time_work ? 'Available' : 'Not Available' }}</p>
                    <a href="{{ route('cities.show', $city) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection