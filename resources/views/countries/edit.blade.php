@extends('layouts.app')

@section('content')
<h2>Edit Country</h2>

<form method="POST" action="{{ route('countries.update', $country) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Country Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $country->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $country->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection