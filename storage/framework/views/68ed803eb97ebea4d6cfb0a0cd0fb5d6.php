<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['review']));

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

foreach (array_filter((['review']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
    <div class="flex gap-4">
        <img src="<?php echo e($review->anime->cover_image_url); ?>" alt="<?php echo e($review->anime->preferred_display_title); ?> cover" class="h-24 w-16 rounded-md object-cover">
        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2 text-xs text-zinc-400">
                <img src="<?php echo e($review->user->avatar_url); ?>" alt="<?php echo e($review->user->public_name); ?> avatar" class="h-6 w-6 rounded-full">
                <a href="<?php echo e(route('profiles.show', $review->user)); ?>" class="font-semibold text-white"><?php echo e($review->user->public_name); ?></a>
                <span>reviewed</span>
                <a href="<?php echo e(route('anime.show', $review->anime)); ?>" class="font-semibold text-white"><?php echo e($review->anime->preferred_display_title); ?></a>
            </div>
            <h3 class="mt-2 text-lg font-black"><a href="<?php echo e(route('reviews.show', $review)); ?>"><?php echo e($review->headline); ?></a></h3>
            <div class="mt-2 flex flex-wrap gap-2 text-xs font-semibold">
                <span class="rounded bg-rose-600 px-2 py-1 text-white"><?php echo e($review->score); ?>/100</span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($review->contains_spoilers): ?>
                    <span class="rounded bg-amber-300 px-2 py-1 text-zinc-950">Spoilers</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <span class="text-zinc-400"><?php echo e($review->likes->count()); ?> likes</span>
                <span class="text-zinc-400"><?php echo e($review->comments->count()); ?> comments</span>
            </div>
            <p class="mt-3 line-clamp-3 text-sm leading-6 text-zinc-300"><?php echo e($review->body); ?></p>
        </div>
    </div>
</article>
<?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views/components/review-card.blade.php ENDPATH**/ ?>