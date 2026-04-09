@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $city->name }}</h2>
        <p><strong>Country:</strong> {{ $city->country->name }}</p>
        <p><strong>Cost of living:</strong> {{ $city->cost_of_living }}</p>
        <p><strong>Climate:</strong> {{ $city->climate }}</p>
        <p><strong>Safety level:</strong> {{ $city->safety_level }}/5</p>
        <p><strong>Transport system:</strong> {{ $city->transport_system }}</p>
        <p><strong>Part-time work available:</strong> {{ $city->part_time_work ? 'Yes' : 'No' }}</p>
    </div>
</div>

<h3>Experiences</h3>
@forelse($city->experiences as $experience)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $experience->housing_type }}</h5>
            <p><strong>Budget:</strong> {{ $experience->monthly_budget }}</p>
            <p><strong>Cultural challenges:</strong> {{ $experience->cultural_challenges }}</p>
            <p><strong>Academic environment:</strong> {{ $experience->academic_environment }}</p>
            <p><strong>Part-time job:</strong> {{ $experience->part_time_job_experience }}</p>
            <p><strong>By:</strong> {{ $experience->user->name }}</p>

            @auth
                <form method="POST" action="{{ route('vote.store', ['type' => 'experience', 'id' => $experience->id]) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="vote" value="1">
                    <button class="btn btn-success btn-sm">Upvote</button>
                </form>

                <form method="POST" action="{{ route('vote.store', ['type' => 'experience', 'id' => $experience->id]) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="vote" value="-1">
                    <button class="btn btn-danger btn-sm">Downvote</button>
                </form>
            @endauth

            <span class="ms-2">Score: {{ $experience->vote_score }}</span>
        </div>
    </div>
@empty
    <p>No experiences yet.</p>
@endforelse

<h3 class="mt-4">Questions</h3>
@forelse($city->questions as $question)
    <div class="card mb-3">
        <div class="card-body">
            <h5>
                <a href="{{ route('questions.show', $question) }}">{{ $question->title }}</a>
            </h5>
            <p>{{ $question->body }}</p>
            <p class="text-muted">By {{ $question->user->name }}</p>
        </div>
    </div>
@empty
    <p>No questions yet.</p>
@endforelse
@endsection