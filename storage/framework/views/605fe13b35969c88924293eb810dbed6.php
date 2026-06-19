<?php $__env->startSection('title', $review->exists ? 'Edit Review' : 'Write Review'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex gap-4">
            <img src="<?php echo e($anime->cover_image_url); ?>" alt="<?php echo e($anime->preferred_display_title); ?> cover" class="h-32 w-24 rounded object-cover">
            <div>
                <h1 class="text-4xl font-black"><?php echo e($review->exists ? 'Edit Review' : 'Write Review'); ?></h1>
                <p class="mt-2 text-zinc-400"><?php echo e($anime->preferred_display_title); ?></p>
            </div>
        </div>
        <form method="POST" action="<?php echo e($review->exists ? route('reviews.update', $review) : route('reviews.store', $anime)); ?>" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            <?php echo csrf_field(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($review->exists): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <label class="block"><span class="text-sm font-bold">Headline</span><input name="headline" value="<?php echo e(old('headline', $review->headline)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Body</span><textarea name="body" rows="10" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"><?php echo e(old('body', $review->body)); ?></textarea></label>
            <label class="block"><span class="text-sm font-bold">Score</span><input name="score" value="<?php echo e(old('score', $review->score)); ?>" type="number" min="1" max="100" class="mt-1 w-32 rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <div class="flex flex-wrap gap-5 text-sm">
                <label><input name="contains_spoilers" value="1" type="checkbox" <?php if(old('contains_spoilers', $review->contains_spoilers)): echo 'checked'; endif; ?>> Contains spoilers</label>
                <label><input name="comments_enabled" value="1" type="checkbox" <?php if(old('comments_enabled', $review->comments_enabled ?? true)): echo 'checked'; endif; ?>> Allow comments</label>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($review->exists)): ?>
                <select name="publication_status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <option value="published">Publish Review</option>
                    <option value="draft">Save Draft</option>
                </select>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="flex gap-3">
                <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black"><?php echo e($review->exists ? 'Save Changes' : 'Publish Review'); ?></button>
                <a href="<?php echo e(route('anime.show', $anime)); ?>" class="rounded-md border border-white/10 px-5 py-3 text-sm font-bold">Cancel</a>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\reviews\form.blade.php ENDPATH**/ ?>