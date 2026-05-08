<?php $__env->startSection('content'); ?>
<h2>Edit City</h2>

<form method="POST" action="<?php echo e(route('admin.cities.update', $city)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label class="form-label">Country</label>
        <select name="country_id" class="form-select">
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php if(old('country_id', $city->country_id) == $country->id): echo 'selected'; endif; ?>>
                    <?php echo e($country->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">City Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $city->name)); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Cost of Living</label>
        <select name="cost_of_living" class="form-select">
            <option value="Low" <?php if(old('cost_of_living', $city->cost_of_living) == 'Low'): echo 'selected'; endif; ?>>Low</option>
            <option value="Medium" <?php if(old('cost_of_living', $city->cost_of_living) == 'Medium'): echo 'selected'; endif; ?>>Medium</option>
            <option value="High" <?php if(old('cost_of_living', $city->cost_of_living) == 'High'): echo 'selected'; endif; ?>>High</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Climate</label>
        <input type="text" name="climate" class="form-control" value="<?php echo e(old('climate', $city->climate)); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Safety Level (1-5)</label>
        <input type="number" name="safety_level" min="1" max="5" class="form-control" value="<?php echo e(old('safety_level', $city->safety_level)); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Transport System</label>
        <input type="text" name="transport_system" class="form-control" value="<?php echo e(old('transport_system', $city->transport_system)); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Part-time Work Available?</label>
        <select name="part_time_work" class="form-select">
            <option value="1" <?php if(old('part_time_work', $city->part_time_work) == 1): echo 'selected'; endif; ?>>Yes</option>
            <option value="0" <?php if(old('part_time_work', $city->part_time_work) == 0): echo 'selected'; endif; ?>>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo e(route('admin.cities.index')); ?>" class="btn btn-secondary">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/cities/edit.blade.php ENDPATH**/ ?>