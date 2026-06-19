@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Account Settings</h1>
        <form method="POST" action="{{ route('settings.account.update') }}" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf @method('PATCH')
            <label class="block"><span class="text-sm font-bold">Email</span><input name="email" value="{{ auth()->user()->email }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Current password</span><input name="current_password" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">New password</span><input name="password" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Confirm new password</span><input name="password_confirmation" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Account</button>
            <a href="{{ route('settings.account.export') }}" class="ml-3 rounded-md border border-white/10 px-5 py-3 text-sm font-bold">Export Account Data</a>
        </form>
        <form method="POST" action="{{ route('settings.account.destroy') }}" onsubmit="return confirm('Delete your account permanently?')" class="mt-6 space-y-4 rounded-lg border border-rose-400/30 bg-rose-400/10 p-5">
            @csrf @method('DELETE')
            <h2 class="text-xl font-black">Delete Account</h2>
            <input name="password" type="password" placeholder="Password" class="w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
            <input name="confirmation" placeholder="Type DELETE MY ACCOUNT" class="w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Delete Account</button>
        </form>
    </section>
@endsection
