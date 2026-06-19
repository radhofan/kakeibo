<?php $__env->startSection('title', 'Sign In'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto grid min-h-[calc(100vh-80px)] max-w-6xl items-center gap-10 px-4 py-10 sm:px-6 lg:grid-cols-2">
        <div>
            <h1 class="text-5xl font-black">Sign in and pick up your watchlist.</h1>
            <p class="mt-4 text-zinc-400">Use your email or username. After sign in, protected actions return to the page you meant to open.</p>
        </div>
        <form method="POST" action="<?php echo e(route('login')); ?>" class="rounded-lg border border-white/10 bg-white/[0.04] p-6">
            <?php echo csrf_field(); ?>
            <label class="block"><span class="text-sm font-bold">Email or username</span><input name="login" value="<?php echo e(old('login')); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            <label class="mt-4 block"><span class="text-sm font-bold">Password</span><input name="password" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            <label class="mt-4 flex gap-2 text-sm text-zinc-300"><input name="remember" type="checkbox"> Remember me</label>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mt-4 rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <button class="mt-5 w-full rounded-md bg-rose-600 px-4 py-3 text-sm font-black">Sign In</button>
            <div class="mt-4 flex justify-between text-sm text-zinc-400">
                <a href="<?php echo e(route('register')); ?>">Create Account</a>
                <span>Forgot Password</span>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views/auth/login.blade.php ENDPATH**/ ?>