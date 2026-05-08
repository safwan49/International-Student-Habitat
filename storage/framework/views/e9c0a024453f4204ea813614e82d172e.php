<?php $__env->startSection('content'); ?>
<style>
    .feed-wrap {
        max-width: 850px;
        margin: 0 auto;
    }

    .feed-card {
        border: 1px solid #d9dee6 !important;
        border-radius: 14px;
        background: #ffffff !important;
        color: #202124 !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
    }

    .feed-card h4,
    .feed-card p,
    .feed-card span,
    .feed-card div,
    .feed-card strong,
    .feed-card small {
        color: #202124 !important;
    }

    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #8ab4f8 !important;
        color: #202124 !important;
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
        background: #f5f7fb !important;
        color: #4f6fa8 !important;
        font-size: 12px;
        margin-right: 6px;
        margin-bottom: 6px;
        border: 1px solid #d9dee6 !important;
    }

    .feed-meta {
        color: #5f6368 !important;
        font-size: 14px;
    }

    .action-bar {
        border-top: 1px solid #e3e7ee !important;
        padding-top: 12px;
    }

    .feed-title-link {
        text-decoration: none;
        color: #202124 !important;
    }

    .feed-title-link:hover {
        color: #5f86d6 !important;
    }
</style>

<div class="feed-wrap">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Questions Feed</h2>
        <a href="<?php echo e(route('questions.create')); ?>" class="btn btn-primary">Ask Question</a>
    </div>
    <form method="GET" class="feed-card p-3 mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-8">
                <label class="form-label mb-1">Sort questions by</label>
                    <select name="sort" class="form-select">
                    <option value="recent" <?php if($sort === 'recent'): echo 'selected'; endif; ?>>Most Recent</option>
                    <option value="helpful" <?php if($sort === 'helpful'): echo 'selected'; endif; ?>>Most Helpful</option>
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary w-100">Apply Sort</button>
            </div>
        </div>
    </form>

    <?php $__empty_1 = true; $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="feed-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex gap-3">
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
                        <div class="feed-meta">
                            <?php echo e($question->created_at->diffForHumans()); ?>

                        </div>
                    </div>
                </div>

                <?php if(auth()->user()?->id === $question->user_id): ?>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('questions.edit', $question)); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>

                        <form method="POST" action="<?php echo e(route('questions.destroy', $question)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <h4 class="mb-2">
                <a href="<?php echo e(route('questions.show', $question)); ?>" class="feed-title-link">
                    <?php echo e($question->title); ?>

                </a>
            </h4>

            <p class="mb-3"><?php echo e($question->body); ?></p>

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
                <span><strong><?php echo e($question->answers_count); ?></strong> answers</span>
                <span><strong><?php echo e($question->vote_score); ?></strong> score</span>
            </div>

            <div class="action-bar d-flex flex-wrap gap-2">
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

                <a href="<?php echo e(route('questions.show', $question)); ?>" class="btn btn-outline-secondary">
                    View Discussion
                </a>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="feed-card p-4 text-center">
            <h5>No questions yet</h5>
            <p class="text-muted mb-3">No one has posted a question yet.</p>
            <a href="<?php echo e(route('questions.create')); ?>" class="btn btn-primary">Ask the First Question</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/questions/index.blade.php ENDPATH**/ ?>