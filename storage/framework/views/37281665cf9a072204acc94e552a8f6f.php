<?php $__env->startSection('title', 'Profile Settings'); ?>

<?php $__env->startSection('content'); ?>
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Profile Settings</h1>
        <form method="POST" action="<?php echo e(route('settings.profile.update')); ?>" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <label class="block"><span class="text-sm font-bold">Display name</span><input name="display_name" value="<?php echo e(old('display_name', auth()->user()->display_name)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Username</span><input name="username" value="<?php echo e(old('username', auth()->user()->username)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Bio</span><textarea name="bio" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"><?php echo e(old('bio', auth()->user()->bio)); ?></textarea></label>
            <label class="block"><span class="text-sm font-bold">Location</span><input name="location" value="<?php echo e(old('location', auth()->user()->location)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Avatar URL</span><input name="avatar_url" value="<?php echo e(old('avatar_url', auth()->user()->avatar_url)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Banner URL</span><input name="banner_url" value="<?php echo e(old('banner_url', auth()->user()->banner_url)); ?>" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <select name="preferred_title_language" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['romaji', 'english', 'native']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($value); ?>" <?php if(auth()->user()->preferred_title_language === $value): echo 'selected'; endif; ?>><?php echo e(ucfirst($value)); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100"><?php echo e($errors->first()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Changes</button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\MyFiles\01_DEVELOPMENT\tanren-works\kakeibo\resources\views\settings\profile.blade.php ENDPATH**/ ?>