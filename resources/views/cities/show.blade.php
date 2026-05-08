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
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Community Rating</h5>

        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="fs-4 fw-bold text-warning">{{ $city->averageRating() ?: '—' }}</span>
            <span class="text-warning fs-5">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= round($city->averageRating()) ? '★' : '☆' }}
                @endfor
            </span>
            <span class="text-muted small">({{ $city->ratings()->count() }} rating(s))</span>
        </div>

        @auth
            <form method="POST" action="{{ route('cities.rate', $city) }}">
                @csrf
                <label class="form-label fw-medium">Your Rating</label>
                <div class="d-flex gap-2 mb-2" style="font-size: 1.8rem; cursor: pointer;">
                    @for($i = 1; $i <= 5; $i++)
                        <label>
                            <input type="radio" name="rating" value="{{ $i }}"
                                   class="visually-hidden"
                                   {{ $city->userRating() == $i ? 'checked' : '' }}>
                            <span class="{{ $city->userRating() >= $i ? 'text-warning' : 'text-secondary' }}">★</span>
                        </label>
                    @endfor
                </div>
                <button type="submit" class="btn btn-warning btn-sm">Submit Rating</button>
            </form>
        @else
            <p class="text-muted small"><a href="{{ route('login') }}">Log in</a> to submit a rating.</p>
        @endauth
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
            <x-reputation-badge :user="$experience->user" />
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
                <x-report-button type="experience" :id="$experience->id" />
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
            <x-reputation-badge :user="$question->user" />
            @auth
                <x-report-button type="question" :id="$question->id" />
            @endauth
        </div>
    </div>
@empty
    <p>No questions yet.</p>
@endforelse
@endsection