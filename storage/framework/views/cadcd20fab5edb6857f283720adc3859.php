<?php $__env->startSection('title', 'Create Account'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto grid min-h-[calc(100vh-80px)] max-w-6xl items-center gap-10 px-4 py-10 sm:px-6 lg:grid-cols-2">
        <div>
            <h1 class="text-5xl font-black">Create a public anime profile.</h1>
            <p class="mt-4 text-zinc-400">Your username becomes your profile route and your display name is what people see beside reviews.</p>
        </div>
        <form method="POST" action="<?php echo e(route('register')); ?>" class="rounded-lg border border-white/10 bg-white/[0.04] p-6">
            <?php echo csrf_field(); ?>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block"><span class="text-sm font-bold">Display name</span><input name="display_name" value="<?php echo e(old('display_name')); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
                <label class="block"><span class="text-sm font-bold">Username</span><input name="username" value="<?php echo e(old('username')); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            </div>
            <label class="mt-4 block"><span class="text-sm font-bold">Email</span><input name="email" value="<?php echo e(old('email')); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <label class="block"><span class="text-sm font-bold">Password</span><input name="password" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
                <label class="block"><span class="text-sm font-bold">Confirm password</span><input name="password_confirmation" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mt-4 rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <button class="mt-5 w-full rounded-md bg-rose-600 px-4 py-3 text-sm font-black">Create Account</button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\auth\register.blade.php ENDPATH**/ ?>