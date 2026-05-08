<?php $__env->startSection('content'); ?>
<style>
    .dashboard-wrap {
        max-width: 900px;
        margin: 0 auto;
        padding-top: 10px;
    }

    .dashboard-title {
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #f1f3f4;
    }

    .dashboard-subtitle {
        color: #b0b7c3;
        margin-bottom: 30px;
        font-size: 1.05rem;
    }

    .dashboard-card {
        background: #2b2f36;
        border: 1px solid #3a3f47;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 18px;
    }

    .dashboard-card h4 {
        margin-bottom: 10px;
        font-weight: 700;
        color: #f1f3f4;
    }

    .dashboard-card p {
        color: #b0b7c3;
        margin-bottom: 18px;
        line-height: 1.6;
    }

    .dashboard-section-title {
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #8ab4f8;
        margin-bottom: 14px;
        font-weight: 700;
    }
</style>

<div class="dashboard-wrap">
    <h1 class="dashboard-title">Welcome, <?php echo e(auth()->user()?->name); ?></h1>
    <p class="dashboard-subtitle">
        <?php echo e(auth()->user()?->is_admin
            ? 'Manage the platform, review activity, and keep city and country information updated.'
            : 'Explore cities, share experiences, and connect with the student community.'); ?>

    </p>

    <?php if(auth()->user()?->is_admin): ?>
        <div class="dashboard-section-title">Admin Controls</div>

        <div class="dashboard-card">
            <h4>Manage Countries</h4>
            <p>Add new countries, edit existing ones, and keep the platform organized for students.</p>
            <a href="<?php echo e(route('countries.index')); ?>" class="btn btn-primary">Open Countries</a>
        </div>

        <div class="dashboard-card">
            <h4>Manage Cities</h4>
            <p>Create and maintain city records with cost of living, climate, safety, transport, and work information.</p>
            <a href="<?php echo e(route('admin.cities.index')); ?>" class="btn btn-primary">Open Cities</a>
        </div>

        <div class="dashboard-section-title mt-4">Community Overview</div>

        <div class="dashboard-card">
            <h4>View Questions</h4>
            <p>See what users are asking and review the discussions taking place on the platform.</p>
            <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-outline-primary">Go to Questions</a>
        </div>

        <div class="dashboard-card">
            <h4>View Experiences</h4>
            <p>Read student experiences from different cities and understand what users are contributing.</p>
            <a href="<?php echo e(route('experiences.index')); ?>" class="btn btn-outline-primary">Go to Experiences</a>
        </div>

        <div class="dashboard-card">
            <h4>Reported Content</h4>
            <p>Review content that users have flagged as inappropriate and approve or remove it.</p>
            <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-danger">Review Reports</a>
        </div>
    <?php else: ?>
        <div class="dashboard-section-title">Getting Started</div>

        <div class="dashboard-card">
            <h4>Browse Cities</h4>
            <p>Explore cities, compare living conditions, and find useful details for planning your study destination.</p>
            <a href="<?php echo e(route('cities.public')); ?>" class="btn btn-primary">Browse Cities</a>
        </div>

        <div class="dashboard-card">
            <h4>Add Experience</h4>
            <p>Share your own experience so future students can learn from your budget, housing, and academic journey.</p>
            <a href="<?php echo e(route('experiences.create')); ?>" class="btn btn-primary">Add Experience</a>
        </div>

        <div class="dashboard-card">
            <h4>View Experiences</h4>
            <p>Read what other students have shared about living, studying, and working in different cities.</p>
            <a href="<?php echo e(route('experiences.index')); ?>" class="btn btn-outline-primary">View Experiences</a>
        </div>

        <div class="dashboard-card">
            <h4>Ask Question</h4>
            <p>Post a question if you need advice about student life, city choices, part-time work, or academic challenges.</p>
            <a href="<?php echo e(route('questions.create')); ?>" class="btn btn-primary">Ask Question</a>
        </div>

        <div class="dashboard-card">
            <h4>View Questions</h4>
            <p>Join discussions, read what others are asking, and contribute answers that can help the community.</p>
            <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-outline-primary">View Questions</a>
        </div>

        <div class="dashboard-card">
            <h4>Messages</h4>
            <p>Chat directly with other students to ask questions, share tips, or get advice about city life.</p>
            <a href="<?php echo e(route('messages.index')); ?>" class="btn btn-primary">Open Messages</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SIFAT\Downloads\International-Student-Habitat-main\resources\views/dashboard.blade.php ENDPATH**/ ?>