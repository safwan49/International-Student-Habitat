@props(['type', 'id'])

@auth
@php $modalId = 'reportModal-' . $type . '-' . $id; @endphp

{{-- Trigger button --}}
<button type="button"
    class="btn btn-sm btn-outline-danger py-0 px-2"
    style="font-size:11px;"
    data-bs-toggle="modal"
    data-bs-target="#{{ $modalId }}">
    🚩 Report
</button>

{{-- Bootstrap Modal --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            {{-- Header with red background so it never blends --}}
            <div class="modal-header text-white border-0" style="background:#c0392b; border-radius: 8px 8px 0 0;">
                <h5 class="modal-title fw-bold">🚩 Report Content</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Already reported error --}}
                @if(session('report_error'))
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-3">
                        <span style="font-size:18px;">⚠️</span>
                        <div>
                            <strong>Already Reported</strong><br>
                            <span class="small">{{ session('report_error') }}</span>
                        </div>
                    </div>
                @endif

                <p class="text-muted small mb-3">
                    Tell us what's wrong with this content and we'll review it.
                </p>

                <form method="POST"
                      action="{{ route('report.store', ['type' => $type, 'id' => $id]) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Reason <span class="text-danger">*</span>
                        </label>
                        <textarea name="reason" rows="3" maxlength="500" required
                            class="form-control"
                            placeholder="Describe why this content is inappropriate..."></textarea>
                        <div class="form-text">Max 500 characters.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            Submit Report
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endauth