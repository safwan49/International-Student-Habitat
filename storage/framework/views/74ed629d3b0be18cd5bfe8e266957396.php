<?php $__env->startSection('content'); ?>
<h2>Ask Question</h2>

<form method="POST" action="<?php echo e(route('questions.store')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">Related Country (Optional)</label>
        <select name="country_id" class="form-select">
            <option value="">Select Country</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php if(old('country_id') == $country->id): echo 'selected'; endif; ?>>
                    <?php echo e($country->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Related City (Optional)</label>
        <select name="city_id" class="form-select">
            <option value="">Select City</option>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($city->id); ?>" <?php if(old('city_id') == $city->id): echo 'selected'; endif; ?>>
                    <?php echo e($city->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Question Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Question Details</label>
        <textarea name="body" class="form-control" rows="5"><?php echo e(old('body')); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Post Question</button>
    <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-secondary">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/questions/create.blade.php ENDPATH**/ ?>