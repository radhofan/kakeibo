@extends('layouts.app')

@section('title', 'Admin Anime Cache')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Anime Cache</h1>
        @include('admin.partials.nav')
        <form method="POST" action="{{ route('admin.anime-cache.refresh') }}" class="mb-6 flex gap-2 rounded-lg border border-white/10 bg-white/[0.04] p-4">
            @csrf
            <input name="search" placeholder="Search AniList and cache results" class="min-w-0 flex-1 rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
            <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Refresh</button>
        </form>
        <div class="space-y-3">
            @foreach ($anime as $item)
                <div class="flex gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <img src="{{ $item->cover_image_url }}" alt="{{ $item->preferred_display_title }} cover" class="h-20 w-14 rounded object-cover">
                    <div><p class="font-black">{{ $item->preferred_display_title }}</p><p class="text-sm text-zinc-400">External {{ $item->external_id }} · synced {{ $item->metadata_last_synced_at?->diffForHumans() ?: 'never' }}</p></div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $anime->links() }}</div>
    </section>
@endsection
