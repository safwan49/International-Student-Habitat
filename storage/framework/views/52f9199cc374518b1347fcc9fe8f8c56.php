<?php $__env->startSection('content'); ?>
<h2>Add Experience</h2>

<form method="POST" action="<?php echo e(route('experiences.store')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">City</label>
        <select name="city_id" class="form-select">
            <option value="">Select City</option>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($city->id); ?>" <?php if(old('city_id') == $city->id): echo 'selected'; endif; ?>>
                    <?php echo e($city->name); ?> (<?php echo e($city->country->name); ?>)
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Housing Type</label>
        <input type="text" name="housing_type" class="form-control" value="<?php echo e(old('housing_type')); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Monthly Budget</label>
        <input type="number" step="0.01" name="monthly_budget" class="form-control" value="<?php echo e(old('monthly_budget')); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Cultural Challenges</label>
        <textarea name="cultural_challenges" class="form-control" rows="4"><?php echo e(old('cultural_challenges')); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Academic Environment</label>
        <textarea name="academic_environment" class="form-control" rows="4"><?php echo e(old('academic_environment')); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Part-time Job Experience</label>
        <textarea name="part_time_job_experience" class="form-control" rows="4"><?php echo e(old('part_time_job_experience')); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo e(route('experiences.index')); ?>" class="btn btn-secondary">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/experiences/create.blade.php ENDPATH**/ ?>