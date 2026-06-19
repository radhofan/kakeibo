<?php $__env->startSection('content'); ?>
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-700">Manage recurring payment</p>
            <h1 class="mt-1 text-2xl font-bold">Edit <?php echo e($subscription->name); ?></h1>
        </div>
        <form method="POST" action="<?php echo e(route('subscriptions.update', $subscription)); ?>" class="space-y-5 rounded-xl border border-slate-200 bg-white p-6">
            <?php echo method_field('PATCH'); ?>
            <?php echo $__env->make('subscriptions._form', ['button' => 'Update subscription'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
        <form method="POST" action="<?php echo e(route('subscriptions.destroy', $subscription)); ?>" class="rounded-xl border border-red-200 bg-red-50 p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="font-semibold text-red-900">Delete subscription</h2>
                    <p class="text-sm text-red-700">Remove this recurring payment from the tracker.</p>
                </div>
                <button class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">Delete</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\subscriptions\edit.blade.php ENDPATH**/ ?>