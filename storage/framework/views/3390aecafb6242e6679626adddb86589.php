<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Student Habitat</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Student Habitat</a>

        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="<?php echo e(route('cities.public')); ?>" class="nav-link">Cities</a></li>
                <li class="nav-item"><a href="<?php echo e(route('experiences.index')); ?>" class="nav-link">Experiences</a></li>
                <li class="nav-item"><a href="<?php echo e(route('questions.index')); ?>" class="nav-link">Questions</a></li>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()?->is_admin): ?>
                        <li class="nav-item"><a href="<?php echo e(route('countries.index')); ?>" class="nav-link">Manage Countries</a></li>
                        <li class="nav-item"><a href="<?php echo e(route('admin.cities.index')); ?>" class="nav-link">Manage Cities</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item"><span class="nav-link">Hi, <?php echo e(auth()->user()?->name); ?></span></li>
                    <li class="nav-item">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-light btn-sm mt-1">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="<?php echo e(route('login')); ?>" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="<?php echo e(route('register')); ?>" class="nav-link">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>