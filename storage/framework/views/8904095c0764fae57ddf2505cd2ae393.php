<?php $__env->startSection('title', $review->headline); ?>

<?php $__env->startSection('content'); ?>
    <article class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex gap-4">
            <img src="<?php echo e($review->anime->cover_image_url); ?>" alt="<?php echo e($review->anime->preferred_display_title); ?> cover" class="h-40 w-28 rounded object-cover">
            <div>
                <p class="text-sm text-zinc-400">Review for <a class="text-white" href="<?php echo e(route('anime.show', $review->anime)); ?>"><?php echo e($review->anime->preferred_display_title); ?></a></p>
                <h1 class="mt-2 text-4xl font-black"><?php echo e($review->headline); ?></h1>
                <p class="mt-3 text-zinc-400">by <a class="text-white" href="<?php echo e(route('profiles.show', $review->user)); ?>"><?php echo e($review->user->public_name); ?></a> · <?php echo e($review->score); ?>/100</p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($review->contains_spoilers): ?>
            <div class="mb-6 rounded-lg border border-amber-300/40 bg-amber-300/10 p-4 text-amber-100">This review contains spoilers.</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="prose prose-invert max-w-none rounded-lg border border-white/10 bg-white/[0.04] p-6 leading-8">
            <?php echo nl2br(e($review->body)); ?>

        </div>

        <div class="mt-6 flex gap-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('reviews.like', $review)); ?>"><?php echo csrf_field(); ?><button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Like</button></form>
                <a href="<?php echo e(route('reports.create', ['type' => 'review', 'id' => $review->id])); ?>" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($review->user_id === auth()->id()): ?>
                    <a href="<?php echo e(route('reviews.edit', $review)); ?>" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Edit</a>
                    <form method="POST" action="<?php echo e(route('reviews.destroy', $review)); ?>" onsubmit="return confirm('Delete this review?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="rounded-md border border-rose-400/40 px-4 py-2 text-sm font-bold text-rose-200">Delete</button></form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <section class="mt-10">
            <h2 class="text-2xl font-black">Comments</h2>
            <div class="mt-4 space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $review->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                        <p class="text-sm font-bold"><?php echo e($comment->user->public_name); ?></p>
                        <p class="mt-2 text-zinc-300"><?php echo e($comment->body); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <div class="mt-3 flex gap-2">
                                <form method="POST" action="<?php echo e(route('comments.like', $comment)); ?>"><?php echo csrf_field(); ?><button class="text-sm font-bold text-rose-300">Like</button></form>
                                <a href="<?php echo e(route('reports.create', ['type' => 'comment', 'id' => $comment->id])); ?>" class="text-sm font-bold text-zinc-300">Report</a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($comment->user_id === auth()->id()): ?>
                                    <form method="POST" action="<?php echo e(route('comments.destroy', $comment)); ?>" onsubmit="return confirm('Delete this comment?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-sm font-bold text-rose-200">Delete</button></form>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="text-sm text-zinc-400">No comments yet.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('comments.store', $review)); ?>" class="mt-5 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <?php echo csrf_field(); ?>
                    <label class="block"><span class="text-sm font-bold">Add comment</span><textarea name="body" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></textarea></label>
                    <button class="mt-3 rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Publish Comment</button>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\reviews\show.blade.php ENDPATH**/ ?>