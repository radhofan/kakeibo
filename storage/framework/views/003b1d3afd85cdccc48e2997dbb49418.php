<?php $__env->startSection('title', $profile->public_name); ?>

<?php $__env->startSection('content'); ?>
    <section class="relative">
        <div class="h-56 bg-zinc-800">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($profile->banner_url): ?>
                <img src="<?php echo e($profile->banner_url); ?>" alt="<?php echo e($profile->public_name); ?> banner" class="h-full w-full object-cover">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="mx-auto max-w-7xl px-4 pb-10 sm:px-6">
            <div class="-mt-16 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div class="flex items-end gap-5">
                    <img src="<?php echo e($profile->avatar_url); ?>" alt="<?php echo e($profile->public_name); ?> avatar" class="h-32 w-32 rounded-lg border-4 border-zinc-950 bg-zinc-900 object-cover">
                    <div>
                        <h1 class="text-4xl font-black"><?php echo e($profile->public_name); ?></h1>
                        <p class="text-zinc-400"><?php echo e('@'.$profile->username); ?> · <?php echo e($profile->followers_count); ?> followers · <?php echo e($profile->following_count); ?> following</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->id() === $profile->id): ?>
                            <a href="<?php echo e(route('settings.profile')); ?>" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Edit Profile</a>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('profiles.follow', $profile)); ?>"><?php echo csrf_field(); ?><button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Follow</button></form>
                            <form method="POST" action="<?php echo e(route('profiles.block', $profile)); ?>"><?php echo csrf_field(); ?><button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Block</button></form>
                            <a href="<?php echo e(route('reports.create', ['type' => 'user', 'id' => $profile->id])); ?>" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <p class="mt-6 max-w-3xl text-zinc-300"><?php echo e($profile->bio); ?></p>
            <div class="mt-6 flex flex-wrap gap-2">
                <a href="<?php echo e(route('profiles.show', $profile)); ?>" class="rounded-md bg-white text-zinc-950 px-3 py-2 text-sm font-bold">Overview</a>
                <a href="<?php echo e(route('profiles.library', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Library</a>
                <a href="<?php echo e(route('profiles.reviews', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Reviews</a>
                <a href="<?php echo e(route('profiles.lists', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Lists</a>
                <a href="<?php echo e(route('profiles.activity', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Activity</a>
                <a href="<?php echo e(route('profiles.followers', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Followers</a>
                <a href="<?php echo e(route('profiles.following', $profile)); ?>" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Following</a>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-12 sm:px-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <h2 class="mb-4 text-2xl font-black">Recently Watched</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $profile->libraryEntries->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb4e2efe2740e84d58f282256e6c8b052 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb4e2efe2740e84d58f282256e6c8b052 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.anime-card','data' => ['anime' => $entry->anime]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('anime-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['anime' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($entry->anime)]); ?>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
        <aside>
            <h2 class="mb-4 text-2xl font-black">Recent Reviews</h2>
            <div class="space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $profile->reviews->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.review-card','data' => ['review' => $review]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('review-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['review' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($review)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $attributes = $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $component = $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </aside>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\profiles\show.blade.php ENDPATH**/ ?>