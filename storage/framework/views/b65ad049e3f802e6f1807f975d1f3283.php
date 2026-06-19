<?php $__env->startSection('content'); ?>
    <div class="mx-auto max-w-4xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-700">Reminder simulation</p>
            <h1 class="mt-1 text-2xl font-bold">Upcoming renewals</h1>
            <p class="mt-1 text-sm text-slate-500">Subscriptions renewing in the next 14 days.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $renewals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $renewal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 last:border-b-0">
                    <div>
                        <p class="font-medium"><?php echo e($renewal->name); ?></p>
                        <p class="text-sm text-slate-500"><?php echo e($renewal->category); ?> via <?php echo e($renewal->payment_method ?: 'unspecified payment method'); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">$<?php echo e(number_format($renewal->price, 2)); ?></p>
                        <p class="text-sm text-slate-500"><?php echo e($renewal->next_renewal_date->format('M d')); ?></p>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="p-12 text-center">
                    <h2 class="text-lg font-semibold">No renewals soon</h2>
                    <p class="mt-1 text-sm text-slate-500">You are clear for the next two weeks.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\renewals\index.blade.php ENDPATH**/ ?>