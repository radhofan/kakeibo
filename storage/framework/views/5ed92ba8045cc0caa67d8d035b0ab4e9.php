<?php $__env->startSection('title', 'Admin Anime Cache'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Anime Cache</h1>
        <?php echo $__env->make('admin.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <form method="POST" action="<?php echo e(route('admin.anime-cache.refresh')); ?>" class="mb-6 flex gap-2 rounded-lg border border-white/10 bg-white/[0.04] p-4">
            <?php echo csrf_field(); ?>
            <input name="search" placeholder="Search AniList and cache results" class="min-w-0 flex-1 rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
            <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Refresh</button>
        </form>
        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <img src="<?php echo e($item->cover_image_url); ?>" alt="<?php echo e($item->preferred_display_title); ?> cover" class="h-20 w-14 rounded object-cover">
                    <div><p class="font-black"><?php echo e($item->preferred_display_title); ?></p><p class="text-sm text-zinc-400">External <?php echo e($item->external_id); ?> · synced <?php echo e($item->metadata_last_synced_at?->diffForHumans() ?: 'never'); ?></p></div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <div class="mt-8"><?php echo e($anime->links()); ?></div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\admin\anime-cache.blade.php ENDPATH**/ ?>