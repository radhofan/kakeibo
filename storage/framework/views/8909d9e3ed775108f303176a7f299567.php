<?php $__env->startSection('title', 'Notification Settings'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Notification Settings</h1>
        <?php ($prefs = auth()->user()->notification_preferences ?? []); ?>
        <form method="POST" action="<?php echo e(route('settings.notifications.update')); ?>" class="space-y-3 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['followers' => 'Follower notifications', 'review_likes' => 'Review like notifications', 'comments' => 'Review comment notifications', 'lists' => 'List notifications', 'email' => 'Email notifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <label class="flex gap-3"><input name="<?php echo e($field); ?>" value="1" type="checkbox" <?php if($prefs[$field] ?? true): echo 'checked'; endif; ?>> <?php echo e($label); ?></label>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Changes</button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\settings\notifications.blade.php ENDPATH**/ ?>