<?php $__env->startSection('title', $profile->public_name.' Lists'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black"><?php echo e($profile->public_name); ?> Lists</h1>
        <div class="grid gap-4 md:grid-cols-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('lists.show', $list)); ?>" class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <h2 class="text-xl font-black"><?php echo e($list->title); ?></h2>
                    <p class="mt-2 text-sm text-zinc-400"><?php echo e($list->entries->count()); ?> anime · <?php echo e($list->visibility); ?></p>
                    <p class="mt-2 text-zinc-300"><?php echo e($list->description); ?></p>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <div class="mt-8"><?php echo e($lists->links()); ?></div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\profiles\lists.blade.php ENDPATH**/ ?>