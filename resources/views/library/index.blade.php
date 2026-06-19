@extends('layouts.app')

@section('title', 'My Library')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-4xl font-black">My Library</h1>
                <p class="mt-2 text-zinc-400">{{ $entries->total() }} anime {{ $status ? 'in '.($statuses[$status] ?? $status) : 'across all statuses' }}.</p>
            </div>
            <form class="flex gap-2">
                <input name="q" value="{{ request('q') }}" placeholder="Search library" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Search</button>
            </form>
        </div>

        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('library.index') }}" class="rounded-md px-3 py-2 text-sm font-bold {{ $status ? 'border border-white/10' : 'bg-white text-zinc-950' }}">All</a>
            @foreach ($statuses as $value => $label)
                <a href="{{ route('library.index', $value) }}" class="rounded-md px-3 py-2 text-sm font-bold {{ $status === $value ? 'bg-white text-zinc-950' : 'border border-white/10' }}">{{ $label }}</a>
            @endforeach
        </div>

        <form id="bulk-form" method="POST" action="{{ route('library.bulk') }}" class="mb-6 flex flex-wrap gap-2 rounded-lg border border-white/10 bg-white/[0.04] p-4">
            @csrf @method('PATCH')
            <select name="bulk_action" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="status">Change status</option>
                <option value="privacy">Set privacy</option>
                <option value="favorite">Mark favorite</option>
                <option value="remove">Remove selected</option>
            </select>
            <select name="status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                @foreach ($statuses as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
            </select>
            <select name="visibility" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="public">Public</option><option value="followers">Followers Only</option><option value="private">Private</option>
            </select>
            <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black" onclick="return confirm('Apply bulk action to selected entries?')">Apply to Selected</button>
        </form>

        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($entries as $entry)
                <article class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <div class="flex gap-4">
                        <input form="bulk-form" type="checkbox" name="entry_ids[]" value="{{ $entry->id }}" class="mt-2 h-5 w-5">
                        <img src="{{ $entry->anime->cover_image_url }}" alt="{{ $entry->anime->preferred_display_title }} cover" class="h-36 w-24 rounded object-cover">
                        <div class="flex-1">
                            <h2 class="text-xl font-black"><a href="{{ route('anime.show', $entry->anime) }}">{{ $entry->anime->preferred_display_title }}</a></h2>
                            <p class="mt-1 text-sm text-zinc-400">{{ $entry->statusLabel() }} · Episode {{ $entry->progress }} / {{ $entry->anime->episodes ?: '?' }} · Score {{ $entry->user_score ?: '--' }}</p>
                            <form method="POST" action="{{ route('library.update', $entry) }}" class="mt-4 grid gap-2 sm:grid-cols-5">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm sm:col-span-2">
                                    @foreach ($statuses as $value => $label)
                                        <option value="{{ $value }}" @selected($entry->status === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <input name="progress" value="{{ $entry->progress }}" type="number" min="0" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm">
                                <input name="user_score" value="{{ $entry->user_score }}" type="number" min="1" max="100" class="rounded-md border border-white/10 bg-zinc-900 px-2 py-2 text-sm">
                                <input type="hidden" name="visibility" value="{{ $entry->visibility }}">
                                <button class="rounded-md bg-rose-600 px-3 py-2 text-sm font-black">Update</button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <x-empty-state title="Your anime library is empty." action="Discover Anime" :href="route('discover')">Add any anime from Discover or an anime detail page.</x-empty-state>
            @endforelse
        </div>

        <div class="mt-8">{{ $entries->links() }}</div>
    </section>
@endsection
