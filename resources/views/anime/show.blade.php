@extends('layouts.app')

@section('title', $anime->preferred_display_title)

@section('content')
    <section class="relative overflow-hidden">
        @if ($anime->banner_image_url)
            <img src="{{ $anime->banner_image_url }}" alt="{{ $anime->preferred_display_title }} banner" class="absolute inset-0 h-full w-full object-cover opacity-40">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/80 to-zinc-950/30"></div>
        <div class="relative mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[280px_1fr]">
            <img src="{{ $anime->cover_image_url }}" alt="{{ $anime->preferred_display_title }} cover" class="w-full max-w-[280px] rounded-lg object-cover shadow-2xl">
            <div class="self-end">
                <div class="mb-3 flex flex-wrap gap-2 text-xs font-bold">
                    <span class="rounded bg-amber-300 px-2 py-1 text-zinc-950">{{ $anime->average_score ?: '--' }} score</span>
                    <span class="rounded bg-white/10 px-2 py-1">{{ $anime->format }}</span>
                    <span class="rounded bg-white/10 px-2 py-1">{{ $anime->status }}</span>
                    <span class="rounded bg-white/10 px-2 py-1">{{ $anime->season }} {{ $anime->season_year }}</span>
                </div>
                <h1 class="text-5xl font-black leading-none">{{ $anime->preferred_display_title }}</h1>
                @if ($anime->title_native)
                    <p class="mt-2 text-zinc-300">{{ $anime->title_native }}</p>
                @endif
                <p class="mt-5 max-w-3xl text-base leading-7 text-zinc-200">{{ $anime->synopsis }}</p>
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach ($anime->genres as $genre)
                        <span class="rounded border border-white/10 bg-white/10 px-3 py-1 text-sm">{{ $genre->name }}</span>
                    @endforeach
                </div>
                <div class="mt-8 max-w-4xl">
                    @livewire('library-status-selector', ['anime' => $anime], key('detail-'.$anime->id))
                </div>
                <div class="mt-4 flex gap-3">
                    @auth
                        <a href="{{ route('reviews.create', $anime) }}" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Write Review</a>
                        <a href="{{ route('lists.create') }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Add to Custom List</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Sign in to Review</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1fr_360px]">
        <div class="space-y-10">
            <section>
                <div class="flex flex-wrap gap-2">
                    <a href="#overview" class="rounded-md bg-white px-3 py-2 text-sm font-bold text-zinc-950">Overview</a>
                    <a href="#characters" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Characters</a>
                    <a href="#staff" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Staff</a>
                    <a href="#reviews" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Reviews</a>
                    <a href="#activity" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Activity</a>
                </div>
            </section>

            <section id="overview">
                <h2 class="text-2xl font-black">Overview</h2>
                <dl class="mt-4 grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-5 sm:grid-cols-2">
                    <div><dt class="text-sm text-zinc-400">Episodes</dt><dd class="font-bold">{{ $anime->episodes ?: 'Unknown' }}</dd></div>
                    <div><dt class="text-sm text-zinc-400">Duration</dt><dd class="font-bold">{{ $anime->duration ? $anime->duration.' min' : 'Unknown' }}</dd></div>
                    <div><dt class="text-sm text-zinc-400">Source</dt><dd class="font-bold">{{ $anime->source ?: 'Unknown' }}</dd></div>
                    <div><dt class="text-sm text-zinc-400">Studios</dt><dd class="font-bold">{{ $anime->studios->pluck('name')->join(', ') ?: 'Unknown' }}</dd></div>
                    <div><dt class="text-sm text-zinc-400">Popularity</dt><dd class="font-bold">{{ number_format($anime->popularity) }}</dd></div>
                    <div><dt class="text-sm text-zinc-400">Age Rating</dt><dd class="font-bold">{{ $anime->age_rating ?: 'Not listed' }}</dd></div>
                </dl>
            </section>

            <section id="characters">
                <h2 class="text-2xl font-black">Characters</h2>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    @forelse ($anime->people->where('person_type', 'character') as $person)
                        <div class="flex gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-3">
                            <div class="h-16 w-12 rounded bg-zinc-800">@if($person->image_url)<img src="{{ $person->image_url }}" alt="{{ $person->name }}" class="h-full w-full rounded object-cover">@endif</div>
                            <div><p class="font-bold">{{ $person->name }}</p><p class="text-sm text-zinc-400">{{ $person->role }} @if($person->voice_actor) · VA {{ $person->voice_actor }} @endif</p></div>
                        </div>
                    @empty
                        <x-empty-state title="Character data is not cached yet." />
                    @endforelse
                </div>
            </section>

            <section id="staff">
                <h2 class="text-2xl font-black">Staff</h2>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    @forelse ($anime->people->where('person_type', 'staff') as $person)
                        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4"><p class="font-bold">{{ $person->name }}</p><p class="text-sm text-zinc-400">{{ $person->role }}</p></div>
                    @empty
                        <x-empty-state title="Staff data is not cached yet." />
                    @endforelse
                </div>
            </section>

            <section id="reviews">
                <div class="mb-4 flex items-end justify-between">
                    <h2 class="text-2xl font-black">Reviews</h2>
                    @auth <a href="{{ route('reviews.create', $anime) }}" class="text-sm font-bold text-rose-300">Write a Review</a> @endauth
                </div>
                <div class="space-y-4">
                    @forelse ($anime->reviews->where('publication_status', 'published') as $review)
                        <x-review-card :review="$review" />
                    @empty
                        <x-empty-state title="No reviews have been published yet." action="Write the First Review" :href="auth()->check() ? route('reviews.create', $anime) : route('login')" />
                    @endforelse
                </div>
            </section>
        </div>

        <aside class="space-y-8">
            <section id="activity">
                <h2 class="mb-4 text-xl font-black">Related Anime</h2>
                <div class="space-y-3">
                    @foreach ($related as $item)
                        <a href="{{ route('anime.show', $item) }}" class="flex gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-3">
                            <img src="{{ $item->cover_image_url }}" alt="{{ $item->preferred_display_title }} cover" class="h-20 w-14 rounded object-cover">
                            <div>
                                <p class="font-bold">{{ $item->preferred_display_title }}</p>
                                <p class="text-sm text-zinc-400">Similar pick</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            <section>
                <h2 class="mb-4 text-xl font-black">Recent Activity</h2>
                <div class="space-y-3">
                    @forelse ($activities as $activity)
                        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-3 text-sm text-zinc-300">
                            <strong class="text-white">{{ $activity->user->public_name }}</strong> {{ str_replace('_', ' ', $activity->activity_type) }}
                        </div>
                    @empty
                        <p class="text-sm text-zinc-400">No public activity yet.</p>
                    @endforelse
                </div>
            </section>
        </aside>
    </section>
@endsection
