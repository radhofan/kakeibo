<?php $__env->startSection('title', $list->title); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm text-zinc-400">List by <a class="text-white" href="<?php echo e(route('profiles.show', $list->user)); ?>"><?php echo e($list->user->public_name); ?></a></p>
                <h1 class="text-4xl font-black"><?php echo e($list->title); ?></h1>
                <p class="mt-3 max-w-3xl text-zinc-300"><?php echo e($list->description); ?></p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="flex gap-2">
                    <form method="POST" action="<?php echo e(route('lists.like', $list)); ?>"><?php echo csrf_field(); ?><button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Like <?php echo e($list->likes->count()); ?></button></form>
                    <form method="POST" action="<?php echo e(route('lists.save', $list)); ?>"><?php echo csrf_field(); ?><button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Save <?php echo e($list->saves->count()); ?></button></form>
                    <a href="<?php echo e(route('reports.create', ['type' => 'list', 'id' => $list->id])); ?>" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($list->user_id === auth()->id()): ?>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('lists.edit', $list)); ?>" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Edit List</a>
                        <form method="POST" action="<?php echo e(route('lists.destroy', $list)); ?>" onsubmit="return confirm('Delete this list?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="rounded-md border border-rose-400/40 px-4 py-2 text-sm font-bold text-rose-200">Delete</button></form>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $list->entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="rounded-lg border border-white/10 bg-white/[0.04]">
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($entry->note): ?>
                        <p class="border-t border-white/10 p-3 text-sm text-zinc-300"><?php echo e($entry->note); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views/lists/show.blade.php ENDPATH**/ ?>