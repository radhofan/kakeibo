@extends('layouts.app')

@section('title', 'Top Anime')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Top Anime</h1>
        <div class="my-6 flex flex-wrap gap-2">
            @foreach (['highest-rated' => 'Highest Rated', 'most-popular' => 'Most Popular', 'trending' => 'Trending', 'upcoming' => 'Upcoming'] as $value => $label)
                <a href="{{ route('top-anime', ['category' => $value]) }}" class="rounded-md px-4 py-2 text-sm font-bold {{ $category === $value ? 'bg-rose-600' : 'border border-white/10 text-zinc-300' }}">{{ $label }}</a>
            @endforeach
        </div>

        <div class="space-y-3">
            @foreach ($anime as $index => $item)
                <article class="grid gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4 sm:grid-cols-[64px_88px_1fr_auto] sm:items-center">
                    <div class="text-4xl font-black {{ $index < 3 ? 'text-amber-300' : 'text-zinc-500' }}">#{{ $index + 1 }}</div>
                    <img src="{{ $item->cover_image_url }}" alt="{{ $item->preferred_display_title }} cover" class="h-28 w-20 rounded object-cover">
                    <div>
                        <h2 class="text-xl font-black"><a href="{{ route('anime.show', $item) }}">{{ $item->preferred_display_title }}</a></h2>
                        <p class="mt-1 text-sm text-zinc-400">{{ $item->season_year }} · {{ $item->format }} · {{ $item->genres->take(3)->pluck('name')->join(', ') }}</p>
                        <p class="mt-2 text-sm text-zinc-300">Score {{ $item->average_score ?: '--' }} · Popularity {{ number_format($item->popularity) }}</p>
                    </div>
                    <div class="min-w-[280px]">
                        @livewire('library-status-selector', ['anime' => $item], key('ranked-'.$item->id))
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
