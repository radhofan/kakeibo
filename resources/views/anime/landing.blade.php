@extends('layouts.app')

@section('title', 'Kakeibo Anime')

@section('content')
    @php($hero = $trending->first())
    <section class="relative overflow-hidden">
        @if ($hero?->banner_image_url)
            <img src="{{ $hero->banner_image_url }}" alt="{{ $hero->preferred_display_title }} banner" class="absolute inset-0 h-full w-full object-cover opacity-45">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/80 to-zinc-950/30"></div>
        <div class="relative mx-auto grid min-h-[520px] max-w-7xl items-end px-4 py-16 sm:px-6 lg:grid-cols-[1fr_360px] lg:gap-10">
            <div class="max-w-3xl pb-10">
                <h1 class="text-5xl font-black leading-none sm:text-7xl">Kakeibo Anime</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-zinc-200">Discover anime, track every episode, publish reviews, and follow people whose taste makes your next watch easier to find.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('discover') }}" class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black text-white">Explore Anime</a>
                    @auth
                        <a href="{{ route('library.index') }}" class="rounded-md bg-white px-5 py-3 text-sm font-black text-zinc-950">Open My Library</a>
                    @else
                        <a href="{{ route('register') }}" class="rounded-md bg-white px-5 py-3 text-sm font-black text-zinc-950">Create Your List</a>
                    @endauth
                </div>
            </div>
            @if ($hero)
                <a href="{{ route('anime.show', $hero) }}" class="hidden overflow-hidden rounded-lg border border-white/10 bg-white/10 lg:block">
                    <img src="{{ $hero->cover_image_url }}" alt="{{ $hero->preferred_display_title }} cover" class="h-[440px] w-full object-cover">
                </a>
            @endif
        </div>
    </section>

    <section class="mx-auto max-w-7xl space-y-12 px-4 py-12 sm:px-6">
        <div>
            <div class="mb-5 flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-black">Trending Now</h2>
                    <p class="text-sm text-zinc-400">Cover-first cards with one-step library controls.</p>
                </div>
                <a href="{{ route('discover') }}" class="text-sm font-bold text-rose-300">View all</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @forelse ($trending as $anime)
                    <x-anime-card :anime="$anime" />
                @empty
                    <x-empty-state title="No anime has been cached yet." action="Discover Anime" :href="route('discover')">Run the demo seeder or search after connecting an anime API.</x-empty-state>
                @endforelse
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_420px]">
            <section>
                <div class="mb-5 flex items-end justify-between">
                    <h2 class="text-2xl font-black">Popular This Season</h2>
                    <a href="{{ route('seasonal') }}" class="text-sm font-bold text-rose-300">View Seasonal Anime</a>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($seasonal as $anime)
                        <x-anime-card :anime="$anime" />
                    @endforeach
                </div>
            </section>

            <section>
                <div class="mb-5 flex items-end justify-between">
                    <h2 class="text-2xl font-black">Recent Community Reviews</h2>
                    <a href="{{ route('reviews.index') }}" class="text-sm font-bold text-rose-300">Read reviews</a>
                </div>
                <div class="space-y-4">
                    @forelse ($reviews as $review)
                        <x-review-card :review="$review" />
                    @empty
                        <x-empty-state title="No reviews have been published yet." action="Write the First Review" :href="route('discover')" />
                    @endforelse
                </div>
            </section>
        </div>

        <section class="rounded-lg bg-white p-8 text-zinc-950">
            <div class="grid gap-6 md:grid-cols-[1fr_auto] md:items-center">
                <div>
                    <h2 class="text-3xl font-black">Build a public anime shelf people can actually browse.</h2>
                    <p class="mt-3 max-w-3xl text-zinc-600">Track library status, write spoiler-marked reviews, follow reviewers, and share custom lists from one profile.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="rounded-md bg-zinc-950 px-5 py-3 text-sm font-black text-white">Join the Community</a>
                    <a href="{{ route('search', ['tab' => 'users']) }}" class="rounded-md border border-zinc-300 px-5 py-3 text-sm font-black">Browse Public Profiles</a>
                </div>
            </div>
        </section>
    </section>
@endsection
