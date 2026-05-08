@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Experiences</h2>
    <a href="{{ route('experiences.create') }}" class="btn btn-primary">Add Experience</a>
</div>

@foreach($experiences as $experience)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $experience->city->name }} - {{ $experience->housing_type }}</h5>
            <p><strong>Budget:</strong> {{ $experience->monthly_budget }}</p>
            <p>{{ $experience->cultural_challenges }}</p>
            <p>{{ $experience->academic_environment }}</p>
            <div class="d-flex align-items-center gap-2 mb-1">
                <p class="mb-0"><strong>By:</strong> {{ $experience->user->name }}</p>
                @auth
                    @if(auth()->id() !== $experience->user_id)
                        <a href="{{ route('messages.show', $experience->user) }}"
                            class="btn btn-sm btn-outline-primary py-0 px-2"
                            style="font-size:11px;">💬 Message</a>
                    @endif
                @endauth
            </div>
            <x-reputation-badge :user="$experience->user" />
            
            <a href="{{ route('cities.show', $experience->city) }}" class="btn btn-outline-secondary btn-sm">View City</a>

            @if(auth()->id() === $experience->user_id)
                <a href="{{ route('experiences.edit', $experience) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            @else
                @auth
                    <x-report-button type="experience" :id="$experience->id" />
                @endauth
            @endif
        </div>
    </div>
@endforeach
@endsection