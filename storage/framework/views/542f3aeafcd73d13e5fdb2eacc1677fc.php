<?php $__env->startSection('title', $list->exists ? 'Edit List' : 'Create List'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black"><?php echo e($list->exists ? 'Edit List' : 'Create List'); ?></h1>
        <form method="POST" action="<?php echo e($list->exists ? route('lists.update', $list) : route('lists.store')); ?>" class="space-y-5 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            <?php echo csrf_field(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($list->exists): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <label class="block"><span class="text-sm font-bold">Title</span><input name="title" value="<?php echo e(old('title', $list->title)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Description</span><textarea name="description" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"><?php echo e(old('description', $list->description)); ?></textarea></label>
            <select name="visibility" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['public' => 'Public', 'unlisted' => 'Unlisted', 'private' => 'Private']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($value); ?>" <?php if(old('visibility', $list->visibility ?: 'public') === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <label class="flex gap-3 rounded-md border border-white/10 p-3 text-sm">
                        <input type="checkbox" name="anime_ids[]" value="<?php echo e($item->id); ?>" <?php if($list->exists && $list->entries->pluck('anime_id')->contains($item->id)): echo 'checked'; endif; ?>>
                        <span><?php echo e($item->preferred_display_title); ?></span>
                    </label>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save List</button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\lists\form.blade.php ENDPATH**/ ?>