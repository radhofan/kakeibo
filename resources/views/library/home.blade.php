@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="mx-auto max-w-7xl space-y-10 px-4 py-10 sm:px-6">
        <div>
            <h1 class="text-4xl font-black">Welcome back, {{ auth()->user()->public_name }}</h1>
            <p class="mt-2 text-zinc-400">Continue watching, update progress, and catch up on community activity.</p>
        </div>

        <section>
            <h2 class="mb-4 text-2xl font-black">Continue Watching</h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($watching as $entry)
                    <article class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                        <div class="flex gap-4">
                            <img src="{{ $entry->anime->cover_image_url }}" alt="{{ $entry->anime->preferred_display_title }} cover" class="h-32 w-24 rounded object-cover">
                            <div class="flex-1">
                                <h3 class="font-black">{{ $entry->anime->preferred_display_title }}</h3>
                                <p class="mt-1 text-sm text-zinc-400">Episode {{ $entry->progress }} / {{ $entry->anime->episodes ?: '?' }}</p>
                                <div class="mt-3 h-2 rounded bg-white/10">
                                    <div class="h-2 rounded bg-rose-500" style="width: {{ $entry->anime->episodes ? min(100, ($entry->progress / $entry->anime->episodes) * 100) : 15 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">@livewire('library-status-selector', ['anime' => $entry->anime], key('home-'.$entry->anime_id))</div>
                    </article>
                @empty
                    <x-empty-state title="Nothing is currently marked as Watching." action="Find Something to Watch" :href="route('discover')" />
                @endforelse
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-[1fr_360px]">
            <div>
                <h2 class="mb-4 text-2xl font-black">Personal Recommendations</h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($recommendations as $anime)
                        <x-anime-card :anime="$anime" />
                    @endforeach
                </div>
            </div>
            <aside class="space-y-6">
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <h2 class="text-xl font-black">Library Summary</h2>
                    <div class="mt-4 space-y-2">
                        @foreach (\App\Models\LibraryEntry::STATUSES as $value => $label)
                            <a href="{{ route('library.index', $value) }}" class="flex justify-between rounded-md bg-white/5 px-3 py-2 text-sm">
                                <span>{{ $label }}</span>
                                <strong>{{ $counts[$value] ?? 0 }}</strong>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <h2 class="text-xl font-black">Friends Activity</h2>
                    <div class="mt-4 space-y-3">
                        @foreach ($activities as $activity)
                            <p class="text-sm text-zinc-300"><strong class="text-white">{{ $activity->user->public_name }}</strong> {{ str_replace('_', ' ', $activity->activity_type) }}</p>
                        @endforeach
                    </div>
                </div>
            </aside>
        </section>
    </section>
@endsection
