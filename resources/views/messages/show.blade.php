@extends('layouts.app')

@section('content')
<div style="max-width:600px; margin:0 auto;">

    <div class="mb-3">
        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm">← Inbox</a>
        <span class="ms-3 fw-semibold fs-5">Chat with {{ $user->name }}</span>
    </div>

    {{-- Message thread --}}
    <div class="card mb-3 p-3" style="min-height:300px; display:flex; flex-direction:column; gap:12px;">
        @forelse($messages as $message)
            @php $isMine = $message->sender_id === auth()->id(); @endphp
            <div class="d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                <div>
                        <div class="px-3 py-2 rounded-3"
                             style="max-width:70%; {{ $isMine
                                ? 'background:#0d6efd; color:#fff;'
                                : 'background:#3a3f47; color:#e8eaed;' }}">
                            <div style="font-size:14px;">{{ $message->body }}</div>
                            <div style="font-size:11px; margin-top:4px; opacity:0.7;">
                                {{ $message->created_at->format('M d, H:i') }}
                                @if($isMine && $message->read_at) · Seen @endif
                            </div>
                        </div>
                        @if(!$isMine)
                            <div style="margin-top:4px;">
                                <x-report-button type="message" :id="$message->id" />
                            </div>
                        @endif
                    </div>
            </div>
        @empty
            <p class="text-center py-4"
               style="color:#6c757d; background:#f8f9fa; border-radius:8px; padding:16px;">
                💬 No messages yet — say hello!
            </p>
        @endforelse
    </div>

    {{-- Reply form --}}
    <div class="card p-3">
        <form method="POST" action="{{ route('messages.store', $user) }}">
            @csrf
            <div class="d-flex gap-2">
                <textarea name="body" rows="2"
                    class="form-control"
                    placeholder="Type your message...">{{ old('body') }}</textarea>
                <button type="submit" class="btn btn-primary align-self-end">Send</button>
            </div>
            @error('body')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </form>
    </div>

</div>
@endsection