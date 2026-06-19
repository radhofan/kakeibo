<?php $__env->startSection('title', 'Top Anime'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Top Anime</h1>
        <div class="my-6 flex flex-wrap gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['highest-rated' => 'Highest Rated', 'most-popular' => 'Most Popular', 'trending' => 'Trending', 'upcoming' => 'Upcoming']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('top-anime', ['category' => $value])); ?>" class="rounded-md px-4 py-2 text-sm font-bold <?php echo e($category === $value ? 'bg-rose-600' : 'border border-white/10 text-zinc-300'); ?>"><?php echo e($label); ?></a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="grid gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4 sm:grid-cols-[64px_88px_1fr_auto] sm:items-center">
                    <div class="text-4xl font-black <?php echo e($index < 3 ? 'text-amber-300' : 'text-zinc-500'); ?>">#<?php echo e($index + 1); ?></div>
                    <img src="<?php echo e($item->cover_image_url); ?>" alt="<?php echo e($item->preferred_display_title); ?> cover" class="h-28 w-20 rounded object-cover">
                    <div>
                        <h2 class="text-xl font-black"><a href="<?php echo e(route('anime.show', $item)); ?>"><?php echo e($item->preferred_display_title); ?></a></h2>
                        <p class="mt-1 text-sm text-zinc-400"><?php echo e($item->season_year); ?> · <?php echo e($item->format); ?> · <?php echo e($item->genres->take(3)->pluck('name')->join(', ')); ?></p>
                        <p class="mt-2 text-sm text-zinc-300">Score <?php echo e($item->average_score ?: '--'); ?> · Popularity <?php echo e(number_format($item->popularity)); ?></p>
                    </div>
                    <div class="min-w-[280px]">
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('library-status-selector', ['anime' => $item]);

$__keyOuter = $__key ?? null;

$__key = 'ranked-'.$item->id;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-197036116-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\anime\top.blade.php ENDPATH**/ ?>