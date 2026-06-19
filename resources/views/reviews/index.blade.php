@extends('layouts.app')

@section('title', 'Community Reviews')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <div class="mb-6">
            <h1 class="text-4xl font-black">Community Reviews</h1>
            <form class="mt-5 grid gap-2 sm:grid-cols-[1fr_180px_auto]">
                <input name="q" value="{{ request('q') }}" placeholder="Search reviews" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                <select name="sort" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <option value="newest">Newest</option>
                    <option value="liked" @selected(request('sort') === 'liked')>Most Liked</option>
                    <option value="score" @selected(request('sort') === 'score')>Highest Score</option>
                </select>
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Apply</button>
            </form>
        </div>
        <div class="space-y-4">
            @forelse ($reviews as $review)
                <x-review-card :review="$review" />
            @empty
                <x-empty-state title="No reviews have been published yet." action="Browse Anime" :href="route('discover')" />
            @endforelse
        </div>
        <div class="mt-8">{{ $reviews->links() }}</div>
    </section>
@endsection
