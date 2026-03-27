@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Cities</h2>
    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Add City</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>City</th>
            <th>Country</th>
            <th>Cost</th>
            <th>Climate</th>
            <th>Safety</th>
            <th>Transport</th>
            <th>Part-time Work</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td>{{ $city->country->name }}</td>
                <td>{{ $city->cost_of_living }}</td>
                <td>{{ $city->climate }}</td>
                <td>{{ $city->safety_level }}/5</td>
                <td>{{ $city->transport_system }}</td>
                <td>{{ $city->part_time_work ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No cities found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection