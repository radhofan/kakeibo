<?php $__env->startSection('title', 'Discover Anime'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-8">
            <h1 class="text-4xl font-black">Discover Anime</h1>
            <p class="mt-2 text-zinc-400">Search the local anime cache, filter by genre/year/format, and add titles to your library from the grid.</p>
        </div>

        <form method="GET" class="mb-8 grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-4 lg:grid-cols-[2fr_1fr_1fr_1fr_1fr_auto]">
            <input name="q" value="<?php echo e(request('q')); ?>" placeholder="Search anime" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
            <select name="genre" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="">All genres</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($genre->slug); ?>" <?php if(request('genre') === $genre->slug): echo 'selected'; endif; ?>><?php echo e($genre->name); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <input name="year" value="<?php echo e(request('year')); ?>" placeholder="Year" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
            <select name="format" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="">Any format</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['TV', 'Movie', 'ONA', 'OVA', 'Special']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($format); ?>" <?php if(request('format') === $format): echo 'selected'; endif; ?>><?php echo e($format); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <select name="sort" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="popular">Popularity</option>
                <option value="score" <?php if(request('sort') === 'score'): echo 'selected'; endif; ?>>Average Score</option>
                <option value="newest" <?php if(request('sort') === 'newest'): echo 'selected'; endif; ?>>Newest</option>
                <option value="oldest" <?php if(request('sort') === 'oldest'): echo 'selected'; endif; ?>>Oldest</option>
                <option value="title" <?php if(request('sort') === 'title'): echo 'selected'; endif; ?>>Title A-Z</option>
            </select>
            <div class="flex gap-2">
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Apply</button>
                <a href="<?php echo e(route('discover')); ?>" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Clear</a>
            </div>
        </form>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($apiWarning): ?>
            <div class="mb-6 rounded-md border border-amber-300/30 bg-amber-300/10 px-4 py-3 text-sm text-amber-100"><?php echo e($apiWarning); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $anime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb4e2efe2740e84d58f282256e6c8b052 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb4e2efe2740e84d58f282256e6c8b052 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.anime-card','data' => ['anime' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('anime-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['anime' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb4e2efe2740e84d58f282256e6c8b052)): ?>
<?php $attributes = $__attributesOriginalb4e2efe2740e84d58f282256e6c8b052; ?>
<?php unset($__attributesOriginalb4e2efe2740e84d58f282256e6c8b052); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb4e2efe2740e84d58f282256e6c8b052)): ?>
<?php $component = $__componentOriginalb4e2efe2740e84d58f282256e6c8b052; ?>
<?php unset($__componentOriginalb4e2efe2740e84d58f282256e6c8b052); ?>
<?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'No anime matched your filters.','action' => 'Clear All','href' => route('discover')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No anime matched your filters.','action' => 'Clear All','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Try a broader search or remove a selected filter. <?php echo $__env->renderComponent(); ?>
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

        <div class="mt-8"><?php echo e($anime->links()); ?></div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\anime\discover.blade.php ENDPATH**/ ?>