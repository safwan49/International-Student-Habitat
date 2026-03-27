@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Countries</h2>
    <a href="{{ route('countries.create') }}" class="btn btn-primary">Add Country</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($countries as $country)
            <tr>
                <td>{{ $country->name }}</td>
                <td>{{ $country->description }}</td>
                <td>
                    <a href="{{ route('countries.edit', $country) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('countries.destroy', $country) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No countries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection