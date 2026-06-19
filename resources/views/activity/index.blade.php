@extends('layouts.app')

@section('title', 'Activity')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Activity</h1>
        <div class="my-6 flex gap-2">
            @foreach (['following' => 'Following', 'global' => 'Global', 'mine' => 'Mine'] as $value => $label)
                <a href="{{ route('activity.index', ['tab' => $value]) }}" class="rounded-md px-4 py-2 text-sm font-bold {{ $tab === $value ? 'bg-white text-zinc-950' : 'border border-white/10' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="space-y-3">
            @forelse ($activities as $activity)
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <p><a class="font-black" href="{{ route('profiles.show', $activity->user) }}">{{ $activity->user->public_name }}</a> {{ str_replace('_', ' ', $activity->activity_type) }}</p>
                    <p class="mt-1 text-sm text-zinc-400">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <x-empty-state title="Follow people or update your library to build your activity feed." action="Browse Anime" :href="route('discover')" />
            @endforelse
        </div>
        <div class="mt-8">{{ $activities->links() }}</div>
    </section>
@endsection
