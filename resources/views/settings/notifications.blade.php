@extends('layouts.app')

@section('title', 'Notification Settings')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Notification Settings</h1>
        @php($prefs = auth()->user()->notification_preferences ?? [])
        <form method="POST" action="{{ route('settings.notifications.update') }}" class="space-y-3 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf @method('PATCH')
            @foreach (['followers' => 'Follower notifications', 'review_likes' => 'Review like notifications', 'comments' => 'Review comment notifications', 'lists' => 'List notifications', 'email' => 'Email notifications'] as $field => $label)
                <label class="flex gap-3"><input name="{{ $field }}" value="1" type="checkbox" @checked($prefs[$field] ?? true)> {{ $label }}</label>
            @endforeach
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Changes</button>
        </form>
    </section>
@endsection
