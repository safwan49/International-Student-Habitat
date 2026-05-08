<?php $__env->startSection('content'); ?>
<style>
    .auth-page {
        min-height: 100vh;
        background: #0f1115;
    }

    .auth-left {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 60px 80px;
        min-height: 100vh;
        background: linear-gradient(135deg, #0f1115 0%, #131a22 100%);
    }

    .auth-card {
        width: 100%;
        max-width: 520px;
        background: rgba(22, 27, 34, 0.92);
        border: 1px solid #2a2f3a;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        color: #f8f9fa;
    }

    .auth-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .auth-subtitle {
        color: #aab2bd;
        margin-bottom: 28px;
    }

    .auth-right {
        min-height: 100vh;
        background:
            linear-gradient(rgba(8, 10, 14, 0.28), rgba(8, 10, 14, 0.40)),
            url('/images/register-bg.jpeg') center center / cover no-repeat;
    }

    .auth-card .form-control {
        border-radius: 12px;
        padding: 12px 14px;
        background: #fff;
    }

    .auth-card .btn-primary {
        border-radius: 12px;
        padding: 10px 18px;
    }

    .auth-card .btn-outline-light {
        border-radius: 12px;
        padding: 10px 18px;
    }

    @media (max-width: 991px) {
        .auth-right {
            display: none;
        }

        .auth-left {
            justify-content: center;
            padding: 30px 20px;
        }
    }
</style>

<div class="container-fluid auth-page">
    <div class="row g-0">
        <div class="col-lg-5 auth-left">
            <div class="auth-card">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Join Student Habitat and start exploring.</p>

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light">Login</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7 auth-right"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/auth/register.blade.php ENDPATH**/ ?>