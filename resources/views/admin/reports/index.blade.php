@extends('layouts.app')

@section('content')
<div style="max-width:860px; margin:0 auto;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h2 style="color:#f1f3f4; margin:0;">
            🚩 Pending Reports
            <span style="background:#3a3f47; color:#e8eaed; font-size:13px;
                         padding:2px 10px; border-radius:999px; margin-left:8px;">
                {{ $reports->total() }}
            </span>
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @forelse($reports as $report)
        <div style="background:#2b2f36; border:1px solid #3a3f47; border-left:4px solid #c5221f;
                    border-radius:14px; padding:24px; margin-bottom:20px;">

            {{-- Header row --}}
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
                <div style="color:#b0b7c3; font-size:13px; line-height:1.6;">
                    Reported by
                    <strong style="color:#f1f3f4;">{{ $report->reporter->name }}</strong>
                    &middot;
                    {{ $report->created_at->diffForHumans() }}
                    &middot;
                    Content type:
                    <code style="background:#1e2128; color:#8ab4f8; padding:2px 7px;
                                 border-radius:4px; font-size:12px;">
                        {{ class_basename($report->reportable_type) }} #{{ $report->reportable_id }}
                    </code>
                </div>
                <span style="background:#4a3b00; color:#fbbf24; border:1px solid #6b4f00;
                             padding:3px 12px; border-radius:999px; font-size:12px;
                             font-weight:600; white-space:nowrap; margin-left:12px;">
                    Pending
                </span>
            </div>

            {{-- Reason --}}
            <div style="margin-bottom:16px; font-size:14px; color:#e8eaed;">
                <span style="color:#8ab4f8; font-weight:600;">Reason: </span>
                {{ $report->reason }}
            </div>

            {{-- Content preview --}}
            @if($report->reportable)
                <div style="background:#1e2128; border:1px solid #3a3f47; border-radius:8px;
                            padding:14px; margin-bottom:18px; font-size:13px; color:#c8cdd6;">
                    <div style="font-size:10px; text-transform:uppercase; letter-spacing:.08em;
                                color:#6c7280; font-weight:700; margin-bottom:6px;">
                        Content Preview
                    </div>
                    {{ Str::limit($report->reportable->body ?? $report->reportable->title ?? '(no preview available)', 300) }}
                </div>
            @else
                <div style="background:#1e2128; border:1px solid #3a3f47; border-radius:8px;
                            padding:14px; margin-bottom:18px; font-size:13px;
                            color:#6c7280; font-style:italic;">
                    This content has already been deleted.
                </div>
            @endif

            {{-- Action buttons --}}
            <div style="display:flex; gap:10px;">
                <form method="POST" action="{{ route('admin.reports.approve', $report) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        ✓ Approve — Keep Content
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('admin.reports.remove', $report) }}"
                      onsubmit="return confirm('Permanently delete this content?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">
                        ✗ Remove Content
                    </button>
                </form>
            </div>

        </div>
    @empty
        <div style="background:#2b2f36; border:1px solid #3a3f47; border-radius:14px;
                    padding:60px 20px; text-align:center; color:#b0b7c3; font-size:16px;">
            🎉 No pending reports right now.
        </div>
    @endforelse

    <div style="margin-top:12px;">
        {{ $reports->links() }}
    </div>

</div>
@endsection