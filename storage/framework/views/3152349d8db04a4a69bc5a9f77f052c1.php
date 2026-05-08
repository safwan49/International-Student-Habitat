<?php $__env->startSection('content'); ?>
<h2>Edit Country</h2>

<form method="POST" action="<?php echo e(route('countries.update', $country)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label class="form-label">Country Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $country->name)); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"><?php echo e(old('description', $country->description)); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo e(route('countries.index')); ?>" class="btn btn-secondary">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/countries/edit.blade.php ENDPATH**/ ?>