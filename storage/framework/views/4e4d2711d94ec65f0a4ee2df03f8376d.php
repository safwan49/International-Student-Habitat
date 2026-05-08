<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between mb-3">
    <h2>Experiences</h2>
    <a href="<?php echo e(route('experiences.create')); ?>" class="btn btn-primary">Add Experience</a>
</div>

<?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5><?php echo e($experience->city->name); ?> - <?php echo e($experience->housing_type); ?></h5>
            <p><strong>Budget:</strong> <?php echo e($experience->monthly_budget); ?></p>
            <p><?php echo e($experience->cultural_challenges); ?></p>
            <p><?php echo e($experience->academic_environment); ?></p>
            <div class="d-flex align-items-center gap-2 mb-1">
                <p class="mb-0"><strong>By:</strong> <?php echo e($experience->user->name); ?></p>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->id() !== $experience->user_id): ?>
                        <a href="<?php echo e(route('messages.show', $experience->user)); ?>"
                            class="btn btn-sm btn-outline-primary py-0 px-2"
                            style="font-size:11px;">💬 Message</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php if (isset($component)) { $__componentOriginal30360e58e6cf0f1fdf509616f4d0df31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.reputation-badge','data' => ['user' => $experience->user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('reputation-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($experience->user)]); ?>
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
            
            <a href="<?php echo e(route('cities.show', $experience->city)); ?>" class="btn btn-outline-secondary btn-sm">View City</a>

            <?php if(auth()->id() === $experience->user_id): ?>
                <a href="<?php echo e(route('experiences.edit', $experience)); ?>" class="btn btn-warning btn-sm">Edit</a>

                <form action="<?php echo e(route('experiences.destroy', $experience)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            <?php else: ?>
                <?php if(auth()->guard()->check()): ?>
                    <?php if (isset($component)) { $__componentOriginalcab7032bfdfb17b0d85d7225950dd852 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcab7032bfdfb17b0d85d7225950dd852 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-button','data' => ['type' => 'experience','id' => $experience->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'experience','id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($experience->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcab7032bfdfb17b0d85d7225950dd852)): ?>
<?php $attributes = $__attributesOriginalcab7032bfdfb17b0d85d7225950dd852; ?>
<?php unset($__attributesOriginalcab7032bfdfb17b0d85d7225950dd852); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcab7032bfdfb17b0d85d7225950dd852)): ?>
<?php $component = $__componentOriginalcab7032bfdfb17b0d85d7225950dd852; ?>
<?php unset($__componentOriginalcab7032bfdfb17b0d85d7225950dd852); ?>
<?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/experiences/index.blade.php ENDPATH**/ ?>