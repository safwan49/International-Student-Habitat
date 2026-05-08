<?php $__env->startSection('content'); ?>
<div style="max-width:600px; margin:0 auto;">

    <h2 class="mb-4">Messages</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="list-group list-group-flush">
            <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('messages.show', $partner)); ?>"
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:50%;background:#8ab4f8;
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:16px;color:#202124;">
                            <?php echo e(strtoupper(substr($partner->name, 0, 1))); ?>

                        </div>
                        <div>
                            <div class="fw-semibold"><?php echo e($partner->name); ?></div>
                            <?php if (isset($component)) { $__componentOriginal30360e58e6cf0f1fdf509616f4d0df31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.reputation-badge','data' => ['user' => $partner]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('reputation-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31)): ?>
<?php $attributes = $__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31; ?>
<?php unset($__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30360e58e6cf0f1fdf509616f4d0df31)): ?>
<?php $component = $__componentOriginal30360e58e6cf0f1fdf509616f4d0df31; ?>
<?php unset($__componentOriginal30360e58e6cf0f1fdf509616f4d0df31); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <?php if(isset($unreadCounts[$partner->id])): ?>
                        <span class="badge bg-danger rounded-pill">
                            <?php echo e($unreadCounts[$partner->id]); ?>

                        </span>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center text-muted py-5">
                    No conversations yet. Click 💬 Message next to any user's name to start chatting.
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/messages/index.blade.php ENDPATH**/ ?>