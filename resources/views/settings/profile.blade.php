@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Profile Settings</h1>
        <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf @method('PATCH')
            <label class="block"><span class="text-sm font-bold">Display name</span><input name="display_name" value="{{ old('display_name', auth()->user()->display_name) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Username</span><input name="username" value="{{ old('username', auth()->user()->username) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Bio</span><textarea name="bio" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">{{ old('bio', auth()->user()->bio) }}</textarea></label>
            <label class="block"><span class="text-sm font-bold">Location</span><input name="location" value="{{ old('location', auth()->user()->location) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Avatar URL</span><input name="avatar_url" value="{{ old('avatar_url', auth()->user()->avatar_url) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Banner URL</span><input name="banner_url" value="{{ old('banner_url', auth()->user()->banner_url) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <select name="preferred_title_language" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                @foreach (['romaji', 'english', 'native'] as $value)<option value="{{ $value }}" @selected(auth()->user()->preferred_title_language === $value)>{{ ucfirst($value) }}</option>@endforeach
            </select>
            @if ($errors->any())<div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100">{{ $errors->first() }}</div>@endif
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Changes</button>
        </form>
    </section>
@endsection
