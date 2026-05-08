<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Cities</h2>
    <a href="<?php echo e(route('admin.cities.create')); ?>" class="btn btn-primary">Add City</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>City</th>
            <th>Country</th>
            <th>Cost</th>
            <th>Climate</th>
            <th>Safety</th>
            <th>Transport</th>
            <th>Part-time Work</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($city->name); ?></td>
                <td><?php echo e($city->country->name); ?></td>
                <td><?php echo e($city->cost_of_living); ?></td>
                <td><?php echo e($city->climate); ?></td>
                <td><?php echo e($city->safety_level); ?>/5</td>
                <td><?php echo e($city->transport_system); ?></td>
                <td><?php echo e($city->part_time_work ? 'Yes' : 'No'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.cities.edit', $city)); ?>" class="btn btn-warning btn-sm">Edit</a>

                    <form action="<?php echo e(route('admin.cities.destroy', $city)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8">No cities found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/cities/index.blade.php ENDPATH**/ ?>