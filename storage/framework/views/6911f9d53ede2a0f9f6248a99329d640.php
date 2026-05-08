<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['user']));

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

foreach (array_filter((['user']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>



<?php
    $colour = $user->reputationBadgeColour();
    $colours = [
        'green' => 'bg-green-100 text-green-800 border border-green-300',
        'blue'  => 'bg-blue-100 text-blue-800 border border-blue-300',
        'gray'  => 'bg-gray-100 text-gray-600 border border-gray-300',
    ];
    $icons = [
        'green' => '🏅',
        'blue'  => '⭐',
        'gray'  => '🌱',
    ];
?>

<span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
             <?php echo e($colours[$colour]); ?>">
    <?php echo e($icons[$colour]); ?>

    <?php echo e($user->reputationTier()); ?>

    <span class="opacity-60 font-normal">(<?php echo e($user->reputation_points); ?> pts)</span>
</span>
<?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/components/reputation-badge.blade.php ENDPATH**/ ?>