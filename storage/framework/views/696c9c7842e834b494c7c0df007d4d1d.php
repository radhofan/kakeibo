<?php $__env->startSection('content'); ?>
    <div class="mx-auto max-w-6xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-600">Kakeibo</p>
            <h1 class="text-2xl font-bold text-gray-950">Subscription overview</h1>
            <p class="text-sm text-gray-500">Track recurring payments before they surprise you.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Monthly total</p>
                <p class="mt-2 text-3xl font-bold">$<?php echo e(number_format($monthlyTotal, 2)); ?></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Yearly projection</p>
                <p class="mt-2 text-3xl font-bold">$<?php echo e(number_format($yearlyProjection, 2)); ?></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Active subscriptions</p>
                <p class="mt-2 text-3xl font-bold"><?php echo e($activeCount); ?></p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <h2 class="font-semibold text-gray-900">Upcoming renewals</h2>
            <div class="mt-4 divide-y divide-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-medium text-gray-900"><?php echo e($subscription->name); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e($subscription->category); ?></p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">$<?php echo e(number_format($subscription->price, 2)); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e($subscription->next_renewal_date->format('M d')); ?></p>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="py-8 text-center text-sm text-gray-500">No upcoming renewals.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\dashboard.blade.php ENDPATH**/ ?>