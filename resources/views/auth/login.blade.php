@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
    <section class="mx-auto grid min-h-[calc(100vh-80px)] max-w-6xl items-center gap-10 px-4 py-10 sm:px-6 lg:grid-cols-2">
        <div>
            <h1 class="text-5xl font-black">Sign in and pick up your watchlist.</h1>
            <p class="mt-4 text-zinc-400">Use your email or username. After sign in, protected actions return to the page you meant to open.</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="rounded-lg border border-white/10 bg-white/[0.04] p-6">
            @csrf
            <label class="block"><span class="text-sm font-bold">Email or username</span><input name="login" value="{{ old('login') }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            <label class="mt-4 block"><span class="text-sm font-bold">Password</span><input name="password" type="password" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-3"></label>
            <label class="mt-4 flex gap-2 text-sm text-zinc-300"><input name="remember" type="checkbox"> Remember me</label>
            @if ($errors->any())
                <div class="mt-4 rounded-md bg-rose-500/10 p-3 text-sm text-rose-100">{{ $errors->first() }}</div>
            @endif
            <button class="mt-5 w-full rounded-md bg-rose-600 px-4 py-3 text-sm font-black">Sign In</button>
            <div class="mt-4 flex justify-between text-sm text-zinc-400">
                <a href="{{ route('register') }}">Create Account</a>
                <span>Forgot Password</span>
            </div>
        </form>
    </section>
@endsection
