<?php $__env->startSection('content'); ?>
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-700">New recurring payment</p>
            <h1 class="mt-1 text-2xl font-bold">Add subscription</h1>
        </div>
        <form method="POST" action="<?php echo e(route('subscriptions.store')); ?>" class="space-y-5 rounded-xl border border-slate-200 bg-white p-6">
            <?php echo $__env->make('subscriptions._form', ['button' => 'Save subscription'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\subscriptions\create.blade.php ENDPATH**/ ?>