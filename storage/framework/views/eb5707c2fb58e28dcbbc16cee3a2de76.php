<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['anime']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['anime']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article class="group overflow-hidden rounded-lg border border-white/10 bg-white/[0.04]">
    <a href="<?php echo e(route('anime.show', $anime)); ?>" class="block">
        <div class="aspect-[3/4] overflow-hidden bg-zinc-800">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($anime->cover_image_url): ?>
                <img src="<?php echo e($anime->cover_image_url); ?>" alt="<?php echo e($anime->preferred_display_title); ?> cover" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
            <?php else: ?>
                <div class="grid h-full place-items-center px-4 text-center text-sm text-zinc-400">No cover available</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="space-y-2 p-3">
            <h3 class="line-clamp-2 min-h-10 text-sm font-bold"><?php echo e($anime->preferred_display_title); ?></h3>
            <div class="flex flex-wrap gap-2 text-xs text-zinc-300">
                <span class="rounded bg-amber-300 px-2 py-1 font-bold text-zinc-950"><?php echo e($anime->average_score ?: '--'); ?></span>
                <span><?php echo e($anime->season_year ?: 'TBA'); ?></span>
                <span><?php echo e($anime->format ?: 'Anime'); ?></span>
            </div>
            <div class="flex flex-wrap gap-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $anime->genres->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <span class="rounded border border-white/10 px-2 py-1 text-xs text-zinc-300"><?php echo e($genre->name); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </a>
    <div class="border-t border-white/10 p-3">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('library-status-selector', ['anime' => $anime]);

$__keyOuter = $__key ?? null;

$__key = 'card-'.$anime->id;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2064490068-0', $__key);

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
<?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\components\anime-card.blade.php ENDPATH**/ ?>