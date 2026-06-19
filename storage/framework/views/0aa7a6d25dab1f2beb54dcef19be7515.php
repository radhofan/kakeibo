<?php $__env->startSection('title', 'Forgot Password'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto grid min-h-[calc(100vh-80px)] max-w-4xl items-center px-4 py-10 sm:px-6">
        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-6">
            <h1 class="text-4xl font-black">Forgot Password</h1>
            <p class="mt-3 text-zinc-400">Password reset delivery is not configured in this local build yet. For demo access, use <strong class="text-white">demo@kakeibo.test</strong> with password <strong class="text-white">password</strong>.</p>
            <a href="<?php echo e(route('login')); ?>" class="mt-6 inline-flex rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Back to Sign In</a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>