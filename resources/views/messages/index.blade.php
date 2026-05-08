@extends('layouts.app')

@section('content')
<div style="max-width:600px; margin:0 auto;">

    <h2 class="mb-4">Messages</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="list-group list-group-flush">
            @forelse($partners as $partner)
                <a href="{{ route('messages.show', $partner) }}"
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:50%;background:#8ab4f8;
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:16px;color:#202124;">
                            {{ strtoupper(substr($partner->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $partner->name }}</div>
                            <x-reputation-badge :user="$partner" />
                        </div>
                    </div>
                    @if(isset($unreadCounts[$partner->id]))
                        <span class="badge bg-danger rounded-pill">
                            {{ $unreadCounts[$partner->id] }}
                        </span>
                    @endif
                </a>
            @empty
                <div class="list-group-item text-center text-muted py-5">
                    No conversations yet. Click 💬 Message next to any user's name to start chatting.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection