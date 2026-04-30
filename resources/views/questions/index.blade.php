@extends('layouts.app')

@section('content')
<style>
    .feed-wrap {
        max-width: 850px;
        margin: 0 auto;
    }

    .feed-card {
        border: 1px solid #d9dee6 !important;
        border-radius: 14px;
        background: #ffffff !important;
        color: #202124 !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
    }

    .feed-card h4,
    .feed-card p,
    .feed-card span,
    .feed-card div,
    .feed-card strong,
    .feed-card small {
        color: #202124 !important;
    }

    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #8ab4f8 !important;
        color: #202124 !important;
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
        background: #f5f7fb !important;
        color: #4f6fa8 !important;
        font-size: 12px;
        margin-right: 6px;
        margin-bottom: 6px;
        border: 1px solid #d9dee6 !important;
    }

    .feed-meta {
        color: #5f6368 !important;
        font-size: 14px;
    }

    .action-bar {
        border-top: 1px solid #e3e7ee !important;
        padding-top: 12px;
    }

    .feed-title-link {
        text-decoration: none;
        color: #202124 !important;
    }

    .feed-title-link:hover {
        color: #5f86d6 !important;
    }
</style>

<div class="feed-wrap">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Questions Feed</h2>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask Question</a>
    </div>
    <form method="GET" class="feed-card p-3 mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-8">
                <label class="form-label mb-1">Sort questions by</label>
                    <select name="sort" class="form-select">
                    <option value="recent" @selected($sort === 'recent')>Most Recent</option>
                    <option value="helpful" @selected($sort === 'helpful')>Most Helpful</option>
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary w-100">Apply Sort</button>
            </div>
        </div>
    </form>

    @forelse($questions as $question)
        <div class="feed-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex gap-3">
                    <div class="avatar-circle">
                        {{ strtoupper(substr($question->user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <div class="fw-semibold">{{ $question->user->name }}</div>
                        <div class="feed-meta">
                            {{ $question->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                @if(auth()->user()?->id === $question->user_id)
                    <div class="d-flex gap-2">
                        <a href="{{ route('questions.edit', $question) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                        <form method="POST" action="{{ route('questions.destroy', $question) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                @endif
            </div>

            <h4 class="mb-2">
                <a href="{{ route('questions.show', $question) }}" class="feed-title-link">
                    {{ $question->title }}
                </a>
            </h4>

            <p class="mb-3">{{ $question->body }}</p>

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
                <span><strong>{{ $question->answers_count }}</strong> answers</span>
                <span><strong>{{ $question->vote_score }}</strong> score</span>
            </div>

            <div class="action-bar d-flex flex-wrap gap-2">
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

                <a href="{{ route('questions.show', $question) }}" class="btn btn-outline-secondary">
                    View Discussion
                </a>
            </div>
        </div>
    @empty
        <div class="feed-card p-4 text-center">
            <h5>No questions yet</h5>
            <p class="text-muted mb-3">No one has posted a question yet.</p>
            <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask the First Question</a>
        </div>
    @endforelse
</div>
@endsection