<?php $__env->startSection('content'); ?>
<div style="max-width:600px; margin:0 auto;">

    <div class="mb-3">
        <a href="<?php echo e(route('messages.index')); ?>" class="btn btn-outline-secondary btn-sm">← Inbox</a>
        <span class="ms-3 fw-semibold fs-5">Chat with <?php echo e($user->name); ?></span>
    </div>

    
    <div class="card mb-3 p-3" style="min-height:300px; display:flex; flex-direction:column; gap:12px;">
        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $isMine = $message->sender_id === auth()->id(); ?>
            <div class="d-flex <?php echo e($isMine ? 'justify-content-end' : 'justify-content-start'); ?>">
                <div>
                        <div class="px-3 py-2 rounded-3"
                             style="max-width:70%; <?php echo e($isMine
                                ? 'background:#0d6efd; color:#fff;'
                                : 'background:#3a3f47; color:#e8eaed;'); ?>">
                            <div style="font-size:14px;"><?php echo e($message->body); ?></div>
                            <div style="font-size:11px; margin-top:4px; opacity:0.7;">
                                <?php echo e($message->created_at->format('M d, H:i')); ?>

                                <?php if($isMine && $message->read_at): ?> · Seen <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!$isMine): ?>
                            <div style="margin-top:4px;">
                                <?php if (isset($component)) { $__componentOriginalcab7032bfdfb17b0d85d7225950dd852 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcab7032bfdfb17b0d85d7225950dd852 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-button','data' => ['type' => 'message','id' => $message->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'message','id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($message->id)]); ?>
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
                            </div>
                        <?php endif; ?>
                    </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center py-4"
               style="color:#6c757d; background:#f8f9fa; border-radius:8px; padding:16px;">
                💬 No messages yet — say hello!
            </p>
        <?php endif; ?>
    </div>

    
    <div class="card p-3">
        <form method="POST" action="<?php echo e(route('messages.store', $user)); ?>">
            <?php echo csrf_field(); ?>
            <div class="d-flex gap-2">
                <textarea name="body" rows="2"
                    class="form-control"
                    placeholder="Type your message..."><?php echo e(old('body')); ?></textarea>
                <button type="submit" class="btn btn-primary align-self-end">Send</button>
            </div>
            <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/messages/show.blade.php ENDPATH**/ ?>