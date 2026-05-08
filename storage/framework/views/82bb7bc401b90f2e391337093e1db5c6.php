<?php $__env->startSection('content'); ?>
<h2 class="mb-4">Browse Cities</h2>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <select name="country_id" class="form-select">
            <option value="">All Countries</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php if(request('country_id') == $country->id): echo 'selected'; endif; ?>>
                    <?php echo e($country->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="cost_of_living" class="form-select">
            <option value="">Any Cost Level</option>
            <?php $__currentLoopData = $costLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($level); ?>" <?php if(request('cost_of_living') == $level): echo 'selected'; endif; ?>>
                    <?php echo e($level); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="climate" class="form-select">
            <option value="">Any Climate</option>
            <?php $__currentLoopData = $climates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $climate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($climate); ?>" <?php if(request('climate') == $climate): echo 'selected'; endif; ?>>
                    <?php echo e($climate); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="safety_level" class="form-select">
            <option value="">Minimum Safety</option>
            <?php for($i = 1; $i <= 5; $i++): ?>
                <option value="<?php echo e($i); ?>" <?php if(request('safety_level') == $i): echo 'selected'; endif; ?>>
                    <?php echo e($i); ?>+
                </option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="transport_system" class="form-select">
            <option value="">Any Transport System</option>
            <?php $__currentLoopData = $transportSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($transport); ?>" <?php if(request('transport_system') == $transport): echo 'selected'; endif; ?>>
                    <?php echo e($transport); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="part_time_work" class="form-select">
            <option value="">Part-time Work Availability</option>
            <option value="1" <?php if(request('part_time_work') === '1'): echo 'selected'; endif; ?>>Available</option>
            <option value="0" <?php if(request('part_time_work') === '0'): echo 'selected'; endif; ?>>Not Available</option>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

    <div class="col-md-3">
        <a href="<?php echo e(route('cities.public')); ?>" class="btn btn-outline-secondary w-100">Reset</a>
    </div>
</form>

<div class="row">
    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5><?php echo e($city->name); ?></h5>
                    <p><strong>Country:</strong> <?php echo e($city->country->name); ?></p>
                    <p><strong>Cost:</strong> <?php echo e($city->cost_of_living); ?></p>
                    <p><strong>Climate:</strong> <?php echo e($city->climate); ?></p>
                    <p><strong>Safety:</strong> <?php echo e($city->safety_level); ?>/5</p>
                    <p><strong>Transport:</strong> <?php echo e($city->transport_system); ?></p>
                    <p><strong>Part-time work:</strong> <?php echo e($city->part_time_work ? 'Available' : 'Not Available'); ?></p>
                    <a href="<?php echo e(route('cities.show', $city)); ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/cities/public-index.blade.php ENDPATH**/ ?>