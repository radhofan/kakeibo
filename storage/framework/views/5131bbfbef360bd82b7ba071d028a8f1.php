<?php $__env->startSection('title', 'Report Content'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Report Content</h1>
        <form method="POST" action="<?php echo e(route('reports.store')); ?>" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="type" value="<?php echo e($type); ?>">
            <input type="hidden" name="id" value="<?php echo e($id); ?>">
            <label class="block">
                <span class="text-sm font-bold">Reason</span>
                <select name="reason" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <option value="spam">Spam</option>
                    <option value="harassment">Harassment</option>
                    <option value="hate">Hate or abusive content</option>
                    <option value="inappropriate">Inappropriate content</option>
                    <option value="spoilers_not_marked">Spoilers not marked</option>
                    <option value="impersonation">Impersonation</option>
                    <option value="other">Other</option>
                </select>
            </label>
            <label class="block"><span class="text-sm font-bold">Details</span><textarea name="details" rows="5" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></textarea></label>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Submit Report</button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\reports\create.blade.php ENDPATH**/ ?>