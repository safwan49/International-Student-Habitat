<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type', 'id']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type', 'id']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(auth()->guard()->check()): ?>
<?php $modalId = 'reportModal-' . $type . '-' . $id; ?>


<button type="button"
    class="btn btn-sm btn-outline-danger py-0 px-2"
    style="font-size:11px;"
    data-bs-toggle="modal"
    data-bs-target="#<?php echo e($modalId); ?>">
    🚩 Report
</button>


<div class="modal fade" id="<?php echo e($modalId); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            
            <div class="modal-header text-white border-0" style="background:#c0392b; border-radius: 8px 8px 0 0;">
                <h5 class="modal-title fw-bold">🚩 Report Content</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                
                <?php if(session('report_error')): ?>
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-3">
                        <span style="font-size:18px;">⚠️</span>
                        <div>
                            <strong>Already Reported</strong><br>
                            <span class="small"><?php echo e(session('report_error')); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <p class="text-muted small mb-3">
                    Tell us what's wrong with this content and we'll review it.
                </p>

                <form method="POST"
                      action="<?php echo e(route('report.store', ['type' => $type, 'id' => $id])); ?>">
                    <?php echo csrf_field(); ?>

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
<?php endif; ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/components/report-button.blade.php ENDPATH**/ ?>