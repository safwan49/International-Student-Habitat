<?php $__env->startSection('content'); ?>
<style>
    .discussion-wrap {
        max-width: 850px;
        margin: 0 auto;
    }

    .discussion-card,
    .answer-card {
        border: 1px solid #e6e9ec;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
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
        background: #eef4ff;
        color: #0d6efd;
        font-size: 12px;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .helpful-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 999px;
    background: #e8f6ee;
    color: #198754;
    border: 1px solid #b7e4c7;
    font-size: 12px;
    font-weight: 700;
    }

</style>

<div class="discussion-wrap">
    <div class="mb-3">
        <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-outline-secondary btn-sm">← Back to Questions</a>
    </div>

    <div class="discussion-card p-4 mb-4">
        <div class="d-flex gap-3 mb-3">
            <div class="avatar-circle">
                <?php echo e(strtoupper(substr($question->user->name ?? 'U', 0, 1))); ?>

            </div>
            <div>
                <div class="d-flex align-items-center gap-2">
                <div class="fw-semibold"><?php echo e($question->user->name); ?></div>
                <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() !== $question->user_id): ?>
                            <a href="<?php echo e(route('messages.show', $question->user)); ?>"
                               class="btn btn-sm btn-outline-primary py-0 px-2"
                               style="font-size:11px;">💬 Message</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
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
                <div class="text-muted small"><?php echo e($question->created_at->diffForHumans()); ?></div>
            </div>
        </div>

        <h2 class="mb-3"><?php echo e($question->title); ?></h2>
        <p><?php echo e($question->body); ?></p>

        <div class="mb-3">
            <?php if($question->country): ?>
                <span class="tag-pill">Country: <?php echo e($question->country->name); ?></span>
            <?php endif; ?>

            <?php if($question->city): ?>
                <span class="tag-pill">City: <?php echo e($question->city->name); ?></span>
            <?php endif; ?>
        </div>

        <div class="d-flex flex-wrap gap-3 mb-3 text-muted small">
            <span><strong><?php echo e($question->upvotes_count); ?></strong> upvotes</span>
            <span><strong><?php echo e($question->downvotes_count); ?></strong> downvotes</span>
            <span><strong><?php echo e($question->vote_score); ?></strong> score</span>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <form method="POST" action="<?php echo e(route('vote.store', ['type' => 'question', 'id' => $question->id])); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="vote" value="1">
                <button type="submit" class="btn <?php echo e($question->userVote() === 1 ? 'btn-primary' : 'btn-outline-primary'); ?>">
                    ▲ Upvote (<?php echo e($question->upvotes_count); ?>)
                </button>
            </form>

            <form method="POST" action="<?php echo e(route('vote.store', ['type' => 'question', 'id' => $question->id])); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="vote" value="-1">
                <button type="submit" class="btn <?php echo e($question->userVote() === -1 ? 'btn-danger' : 'btn-outline-danger'); ?>">
                    ▼ Downvote (<?php echo e($question->downvotes_count); ?>)
                </button>
            </form>
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->id() !== $question->user_id): ?>
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
            <?php endif; ?>
        </div>
    </div>

    <div class="discussion-card p-4 mb-4">
        <h4 class="mb-3">Write an answer</h4>

        <form method="POST" action="<?php echo e(route('answers.store', $question)); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <textarea name="body" rows="4" class="form-control" placeholder="Write your answer here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Answer</button>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Answers</h4>

        <form method="GET" class="d-flex gap-2">
            <select name="answer_sort" class="form-select form-select-sm">
            <option value="recent" <?php if($answerSort === 'recent'): echo 'selected'; endif; ?>>Most Recent</option>
            <option value="helpful" <?php if($answerSort === 'helpful'): echo 'selected'; endif; ?>>Most Helpful</option>
            </select>

            <button class="btn btn-sm btn-outline-primary">Sort</button>
        </form>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="answer-card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <div class="d-flex align-items-center gap-2">
                    <div class="fw-semibold"><?php echo e($answer->user->name); ?></div>
                    <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->id() !== $answer->user_id): ?>
                                <a href="<?php echo e(route('messages.show', $answer->user)); ?>"
                                   class="btn btn-sm btn-outline-primary py-0 px-2"
                                   style="font-size:11px;">💬 Message</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($component)) { $__componentOriginal30360e58e6cf0f1fdf509616f4d0df31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30360e58e6cf0f1fdf509616f4d0df31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.reputation-badge','data' => ['user' => $answer->user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('reputation-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($answer->user)]); ?>
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
                    <div class="text-muted small"><?php echo e($answer->created_at->diffForHumans()); ?></div>
                </div>
                <?php if($answer->is_most_helpful): ?>
                        <span class="helpful-badge">Most Helpful</span>
                <?php endif; ?>    
            </div>

            <p class="mb-3"><?php echo e($answer->body); ?></p>
            <?php if(auth()->id() === $question->user_id && ! $answer->is_most_helpful): ?>
                <form method="POST" action="<?php echo e(route('answers.markMostHelpful', [$question, $answer])); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button class="btn btn-outline-success btn-sm">Mark as Most Helpful</button>
                </form>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->id() !== $answer->user_id): ?>
                    <?php if (isset($component)) { $__componentOriginalcab7032bfdfb17b0d85d7225950dd852 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcab7032bfdfb17b0d85d7225950dd852 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-button','data' => ['type' => 'answer','id' => $answer->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'answer','id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($answer->id)]); ?>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="answer-card p-4">
            <p class="mb-0 text-muted">No answers yet.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/questions/show.blade.php ENDPATH**/ ?>