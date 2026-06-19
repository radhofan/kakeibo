<?php $__env->startSection('title', 'My Library'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-4xl font-black">My Library</h1>
                <p class="mt-2 text-zinc-400"><?php echo e($entries->total()); ?> anime <?php echo e($status ? 'in '.($statuses[$status] ?? $status) : 'across all statuses'); ?>.</p>
            </div>
            <form class="flex gap-2">
                <input name="q" value="<?php echo e(request('q')); ?>" placeholder="Search library" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Search</button>
            </form>
        </div>

        <div class="mb-6 flex flex-wrap gap-2">
            <a href="<?php echo e(route('library.index')); ?>" class="rounded-md px-3 py-2 text-sm font-bold <?php echo e($status ? 'border border-white/10' : 'bg-white text-zinc-950'); ?>">All</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('library.index', $value)); ?>" class="rounded-md px-3 py-2 text-sm font-bold <?php echo e($status === $value ? 'bg-white text-zinc-950' : 'border border-white/10'); ?>"><?php echo e($label); ?></a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <form id="bulk-form" method="POST" action="<?php echo e(route('library.bulk')); ?>" class="mb-6 flex flex-wrap gap-2 rounded-lg border border-white/10 bg-white/[0.04] p-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <select name="bulk_action" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="status">Change status</option>
                <option value="privacy">Set privacy</option>
                <option value="favorite">Mark favorite</option>
                <option value="remove">Remove selected</option>
            </select>
            <select name="status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($value); ?>"><?php echo e($label); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <select name="visibility" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="public">Public</option><option value="followers">Followers Only</option><option value="private">Private</option>
            </select>
            <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black" onclick="return confirm('Apply bulk action to selected entries?')">Apply to Selected</button>
        </form>

        <div class="grid gap-4 md:grid-cols-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <div class="flex gap-4">
                        <input form="bulk-form" type="checkbox" name="entry_ids[]" value="<?php echo e($entry->id); ?>" class="mt-2 h-5 w-5">
                        <img src="<?php echo e($entry->anime->cover_image_url); ?>" alt="<?php echo e($entry->anime->preferred_display_title); ?> cover" class="h-36 w-24 rounded object-cover">
                        <div class="flex-1">
                            <h2 class="text-xl font-black"><a href="<?php echo e(route('anime.show', $entry->anime)); ?>"><?php echo e($entry->anime->preferred_display_title); ?></a></h2>
                            <p class="mt-1 text-sm text-zinc-400"><?php echo e($entry->statusLabel()); ?> · Episode <?php echo e($entry->progress); ?> / <?php echo e($entry->anime->episodes ?: '?'); ?> · Score <?php echo e($entry->user_score ?: '--'); ?></p>
                            <form method="POST" action="<?php echo e(route('library.update', $entry)); ?>" class="mt-4 grid gap-2 sm:grid-cols-5">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="status" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm sm:col-span-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($value); ?>" <?php if($entry->status === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <input name="progress" value="<?php echo e($entry->progress); ?>" type="number" min="0" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm">
                                <input name="user_score" value="<?php echo e($entry->user_score); ?>" type="number" min="1" max="100" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm">
                                <input type="hidden" name="visibility" value="<?php echo e($entry->visibility); ?>">
                                <button class="rounded-md bg-rose-600 px-3 py-2 text-sm font-black">Update</button>
                            </form>
                        </div>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'Your anime library is empty.','action' => 'Discover Anime','href' => route('discover')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Your anime library is empty.','action' => 'Discover Anime','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Add any anime from Discover or an anime detail page. <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-8"><?php echo e($entries->links()); ?></div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views/library/index.blade.php ENDPATH**/ ?>