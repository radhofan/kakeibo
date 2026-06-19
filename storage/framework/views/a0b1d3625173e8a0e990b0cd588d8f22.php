<div class="text-white">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
        <div class="flex items-center justify-between gap-3">
            <span class="text-xs font-semibold uppercase text-zinc-400">Library</span>
            <a href="<?php echo e(route('login', ['redirect' => request()->fullUrl()])); ?>" class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Sign in to track</a>
        </div>
    <?php else: ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="mb-3 rounded-md border border-emerald-500/30 bg-emerald-950/50 px-3 py-2 text-sm font-medium text-emerald-200"><?php echo e(session('status')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="flex items-center justify-between gap-3">
        <span class="text-xs font-semibold uppercase text-zinc-400">Library status</span>
        <button wire:click="toggleStatusOptions" title="Change library status" class="rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm font-semibold text-white">
            <?php echo e($statuses[$status]); ?>

        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showStatusOptions): ?>
        <div class="mt-2 grid grid-cols-2 gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <button wire:click="setStatus('<?php echo e($value); ?>')" class="rounded-md border px-3 py-2 text-left text-sm font-medium <?php echo e($status === $value ? 'border-rose-500 bg-rose-600 text-white' : 'border-white/15 bg-zinc-900 text-zinc-200'); ?>">
                    <?php echo e($label); ?>

                </button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="mt-3 grid grid-cols-2 gap-2">
        <label class="block min-w-0">
            <span class="text-xs font-semibold uppercase text-zinc-400">Progress</span>
            <input wire:model="progress" type="number" min="0" max="<?php echo e($anime->episodes); ?>" class="mt-1 w-full appearance-none rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm text-white">
        </label>

        <label class="block min-w-0">
            <span class="text-xs font-semibold uppercase text-zinc-400">Score</span>
            <input wire:model="userScore" type="number" min="1" max="100" class="mt-1 w-full appearance-none rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm text-white placeholder:text-zinc-500" placeholder="--">
        </label>
    </div>

    <div class="mt-3 grid grid-cols-2 gap-2">
        <button wire:click="incrementProgress" class="rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm font-semibold text-zinc-100">+1 episode</button>
        <button wire:click="save" class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Save</button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['progress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="mt-2 text-sm text-rose-300"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views/livewire/library-status-selector.blade.php ENDPATH**/ ?>