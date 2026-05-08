<?php $__env->startSection('content'); ?>
<div class="card mb-4">
    <div class="card-body">
        <h2><?php echo e($city->name); ?></h2>
        <p><strong>Country:</strong> <?php echo e($city->country->name); ?></p>
        <p><strong>Cost of living:</strong> <?php echo e($city->cost_of_living); ?></p>
        <p><strong>Climate:</strong> <?php echo e($city->climate); ?></p>
        <p><strong>Safety level:</strong> <?php echo e($city->safety_level); ?>/5</p>
        <p><strong>Transport system:</strong> <?php echo e($city->transport_system); ?></p>
        <p><strong>Part-time work available:</strong> <?php echo e($city->part_time_work ? 'Yes' : 'No'); ?></p>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Community Rating</h5>

        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="fs-4 fw-bold text-warning"><?php echo e($city->averageRating() ?: '—'); ?></span>
            <span class="text-warning fs-5">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <?php echo e($i <= round($city->averageRating()) ? '★' : '☆'); ?>

                <?php endfor; ?>
            </span>
            <span class="text-muted small">(<?php echo e($city->ratings()->count()); ?> rating(s))</span>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('cities.rate', $city)); ?>">
                <?php echo csrf_field(); ?>
                <label class="form-label fw-medium">Your Rating</label>
                <div class="d-flex gap-2 mb-2" style="font-size: 1.8rem; cursor: pointer;">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <label>
                            <input type="radio" name="rating" value="<?php echo e($i); ?>"
                                   class="visually-hidden"
                                   <?php echo e($city->userRating() == $i ? 'checked' : ''); ?>>
                            <span class="<?php echo e($city->userRating() >= $i ? 'text-warning' : 'text-secondary'); ?>">★</span>
                        </label>
                    <?php endfor; ?>
                </div>
                <button type="submit" class="btn btn-warning btn-sm">Submit Rating</button>
            </form>
        <?php else: ?>
            <p class="text-muted small"><a href="<?php echo e(route('login')); ?>">Log in</a> to submit a rating.</p>
        <?php endif; ?>
    </div>
</div>
<h3>Experiences</h3>
<?php $__empty_1 = true; $__currentLoopData = $city->experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5><?php echo e($experience->housing_type); ?></h5>
            <p><strong>Budget:</strong> <?php echo e($experience->monthly_budget); ?></p>
            <p><strong>Cultural challenges:</strong> <?php echo e($experience->cultural_challenges); ?></p>
            <p><strong>Academic environment:</strong> <?php echo e($experience->academic_environment); ?></p>
            <p><strong>Part-time job:</strong> <?php echo e($experience->part_time_job_experience); ?></p>
            <p><strong>By:</strong> <?php echo e($experience->user->name); ?></p>
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
            <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('vote.store', ['type' => 'experience', 'id' => $experience->id])); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="vote" value="1">
                    <button class="btn btn-success btn-sm">Upvote</button>
                </form>

                <form method="POST" action="<?php echo e(route('vote.store', ['type' => 'experience', 'id' => $experience->id])); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="vote" value="-1">
                    <button class="btn btn-danger btn-sm">Downvote</button>
                </form>
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

            <span class="ms-2">Score: <?php echo e($experience->vote_score); ?></span>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>No experiences yet.</p>
<?php endif; ?>

<h3 class="mt-4">Questions</h3>
<?php $__empty_1 = true; $__currentLoopData = $city->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5>
                <a href="<?php echo e(route('questions.show', $question)); ?>"><?php echo e($question->title); ?></a>
            </h5>
            <p><?php echo e($question->body); ?></p>
            <p class="text-muted">By <?php echo e($question->user->name); ?></p>
            <?php if (isset($component)) { $__componentOriginal30360e58e6cf0f1fdf509616f4d0df31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.reputation-badge','data' => ['user' => $question->user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('reputation-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($question->user)]); ?>
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
            <?php if(auth()->guard()->check()): ?>
                <?php if (isset($component)) { $__componentOriginalcab7032bfdfb17b0d85d7225950dd852 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcab7032bfdfb17b0d85d7225950dd852 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-button','data' => ['type' => 'question','id' => $question->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'question','id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($question->id)]); ?>
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
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>No questions yet.</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/cities/show.blade.php ENDPATH**/ ?>