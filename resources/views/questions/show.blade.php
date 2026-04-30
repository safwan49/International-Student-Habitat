@extends('layouts.app')

@section('content')
<style>
    .discussion-wrap {
        max-width: 850px;
        margin: 0 auto;
    }

    .discussion-card,
    .answer-card {
        border: 1px solid #e6e9ec;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
    }

    .tag-pill {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        background: #eef4ff;
        color: #0d6efd;
        font-size: 12px;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .helpful-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 999px;
    background: #e8f6ee;
    color: #198754;
    border: 1px solid #b7e4c7;
    font-size: 12px;
    font-weight: 700;
    }

</style>

<div class="discussion-wrap">
    <div class="mb-3">
        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Questions</a>
    </div>

    <div class="discussion-card p-4 mb-4">
        <div class="d-flex gap-3 mb-3">
            <div class="avatar-circle">
                {{ strtoupper(substr($question->user->name ?? 'U', 0, 1)) }}
            </div>
            <div>
                <div class="fw-semibold">{{ $question->user->name }}</div>
                <div class="text-muted small">{{ $question->created_at->diffForHumans() }}</div>
            </div>
        </div>

        <h2 class="mb-3">{{ $question->title }}</h2>
        <p>{{ $question->body }}</p>

        <div class="mb-3">
            @if($question->country)
                <span class="tag-pill">Country: {{ $question->country->name }}</span>
            @endif

            @if($question->city)
                <span class="tag-pill">City: {{ $question->city->name }}</span>
            @endif
        </div>

        <div class="d-flex flex-wrap gap-3 mb-3 text-muted small">
            <span><strong>{{ $question->upvotes_count }}</strong> upvotes</span>
            <span><strong>{{ $question->downvotes_count }}</strong> downvotes</span>
            <span><strong>{{ $question->vote_score }}</strong> score</span>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <form method="POST" action="{{ route('vote.store', ['type' => 'question', 'id' => $question->id]) }}">
                @csrf
                <input type="hidden" name="vote" value="1">
                <button type="submit" class="btn {{ $question->userVote() === 1 ? 'btn-primary' : 'btn-outline-primary' }}">
                    ▲ Upvote ({{ $question->upvotes_count }})
                </button>
            </form>

            <form method="POST" action="{{ route('vote.store', ['type' => 'question', 'id' => $question->id]) }}">
                @csrf
                <input type="hidden" name="vote" value="-1">
                <button type="submit" class="btn {{ $question->userVote() === -1 ? 'btn-danger' : 'btn-outline-danger' }}">
                    ▼ Downvote ({{ $question->downvotes_count }})
                </button>
            </form>
        </div>
    </div>

    <div class="discussion-card p-4 mb-4">
        <h4 class="mb-3">Write an answer</h4>

        <form method="POST" action="{{ route('answers.store', $question) }}">
            @csrf
            <div class="mb-3">
                <textarea name="body" rows="4" class="form-control" placeholder="Write your answer here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Answer</button>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Answers</h4>

        <form method="GET" class="d-flex gap-2">
            <select name="answer_sort" class="form-select form-select-sm">
            <option value="recent" @selected($answerSort === 'recent')>Most Recent</option>
            <option value="helpful" @selected($answerSort === 'helpful')>Most Helpful</option>
            </select>

            <button class="btn btn-sm btn-outline-primary">Sort</button>
        </form>
    </div>

    @forelse($question->answers as $answer)
        <div class="answer-card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <div class="fw-semibold">{{ $answer->user->name }}</div>
                    <div class="text-muted small">{{ $answer->created_at->diffForHumans() }}</div>
                </div>
                @if($answer->is_most_helpful)
                        <span class="helpful-badge">Most Helpful</span>
                @endif    
            </div>

            <p class="mb-3">{{ $answer->body }}</p>
            @if(auth()->id() === $question->user_id && ! $answer->is_most_helpful)
                <form method="POST" action="{{ route('answers.markMostHelpful', [$question, $answer]) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-outline-success btn-sm">Mark as Most Helpful</button>
                </form>
            @endif
        </div>
    @empty
        <div class="answer-card p-4">
            <p class="mb-0 text-muted">No answers yet.</p>
        </div>
    @endforelse
</div>
@endsection