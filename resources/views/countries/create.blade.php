@extends('layouts.app')

@section('content')
<h2>Add Country</h2>

<form method="POST" action="{{ route('countries.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Country Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection