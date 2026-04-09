@extends('layouts.app')

@section('content')
<h2>Edit Question</h2>

<form method="POST" action="{{ route('questions.update', $question) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Related Country (Optional)</label>
        <select name="country_id" class="form-select">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" @selected(old('country_id', $question->country_id) == $country->id)>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Related City (Optional)</label>
        <select name="city_id" class="form-select">
            <option value="">Select City</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" @selected(old('city_id', $question->city_id) == $city->id)>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Question Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $question->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Question Details</label>
        <textarea name="body" class="form-control" rows="5">{{ old('body', $question->body) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection