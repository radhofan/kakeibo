<?php echo csrf_field(); ?>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-slate-700">Name</label>
        <input name="name" value="<?php echo e(old('name', $subscription->name ?? '')); ?>" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Category</label>
        <input name="category" value="<?php echo e(old('category', $subscription->category ?? '')); ?>" required placeholder="Developer Tools" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Price</label>
        <input name="price" type="number" step="0.01" min="0" value="<?php echo e(old('price', $subscription->price ?? '')); ?>" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Billing cycle</label>
        <select name="billing_cycle" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['weekly', 'monthly', 'quarterly', 'yearly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cycle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <option value="<?php echo e($cycle); ?>" <?php if(old('billing_cycle', $subscription->billing_cycle ?? 'monthly') === $cycle): echo 'selected'; endif; ?>><?php echo e(ucfirst($cycle)); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Next renewal date</label>
        <input name="next_renewal_date" type="date" value="<?php echo e(old('next_renewal_date', isset($subscription) ? $subscription->next_renewal_date->format('Y-m-d') : '')); ?>" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Payment method</label>
        <input name="payment_method" value="<?php echo e(old('payment_method', $subscription->payment_method ?? '')); ?>" placeholder="Debit card" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Status</label>
        <select name="status" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['active', 'paused', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <option value="<?php echo e($status); ?>" <?php if(old('status', $subscription->status ?? 'active') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Notes</label>
        <textarea name="notes" rows="4" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo e(old('notes', $subscription->notes ?? '')); ?></textarea>
    </div>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        <?php echo e($errors->first()); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<div class="flex justify-end gap-3">
    <a href="<?php echo e(route('subscriptions.index')); ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Cancel</a>
    <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"><?php echo e($button); ?></button>
</div>
<?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\subscriptions\_form.blade.php ENDPATH**/ ?>