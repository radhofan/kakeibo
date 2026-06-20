@extends('layouts.app')

@section('title', 'Discover Anime')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-8">
            <h1 class="text-4xl font-black">Discover Anime</h1>
            <p class="mt-2 text-zinc-400">Search the local anime cache, filter by genre/year/format, and add titles to your library from the grid.</p>
        </div>

        <form method="GET" class="mb-8 grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-4 lg:grid-cols-[2fr_1fr_1fr_1fr_1fr_auto]">
            <input name="q" value="{{ request('q') }}" placeholder="Search anime" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
            <select name="genre" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="">All genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->slug }}" @selected(request('genre') === $genre->slug)>{{ $genre->name }}</option>
                @endforeach
            </select>
            <input name="year" value="{{ request('year') }}" placeholder="Year" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
            <select name="format" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="">Any format</option>
                @foreach (['TV', 'Movie', 'ONA', 'OVA', 'Special'] as $format)
                    <option value="{{ $format }}" @selected(request('format') === $format)>{{ $format }}</option>
                @endforeach
            </select>
            <select name="sort" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <option value="popular">Popularity</option>
                <option value="score" @selected(request('sort') === 'score')>Average Score</option>
                <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                <option value="title" @selected(request('sort') === 'title')>Title A-Z</option>
            </select>
            <div class="flex gap-2">
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Apply</button>
                <a href="{{ route('discover') }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Clear</a>
            </div>
        </form>

        @if ($apiWarning)
            <div class="mb-6 rounded-md border border-amber-300/30 bg-amber-300/10 px-4 py-3 text-sm text-amber-100">{{ $apiWarning }}</div>
        @endif

        <div id="anime-grid" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($anime as $item)
                <x-anime-card :anime="$item" />
            @empty
                <x-empty-state title="No anime matched your filters." action="Clear All" :href="route('discover')">Try a broader search or remove a selected filter.</x-empty-state>
            @endforelse
        </div>

        @if ($anime->hasMorePages())
            <div class="mt-8 flex justify-center">
                <a id="anime-load-more" href="{{ $anime->nextPageUrl() }}" class="rounded-md border border-white/10 px-5 py-3 text-sm font-bold text-zinc-200 hover:bg-white/10">Load more anime</a>
            </div>
        @endif
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            const grid = document.getElementById('anime-grid');
            let loading = false;

            const loadMore = async () => {
                const link = document.getElementById('anime-load-more');

                if (!link || loading) {
                    return;
                }

                loading = true;
                link.textContent = 'Loading anime...';

                try {
                    const response = await fetch(link.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });

                    if (!response.ok) {
                        throw new Error('Unable to load more anime.');
                    }

                    const document = new DOMParser().parseFromString(await response.text(), 'text/html');
                    const nextGrid = document.getElementById('anime-grid');
                    const nextLink = document.getElementById('anime-load-more');

                    if (nextGrid) {
                        grid.append(...nextGrid.children);
                    }

                    link.parentElement.remove();

                    if (nextLink) {
                        grid.insertAdjacentHTML('afterend', nextLink.parentElement.outerHTML);
                        observeLoadMore();
                    }
                } catch (error) {
                    link.textContent = 'Try loading more anime';
                } finally {
                    loading = false;
                }
            };

            const observeLoadMore = () => {
                const link = document.getElementById('anime-load-more');

                if (!link) {
                    return;
                }

                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    loadMore();
                });

                new IntersectionObserver((entries, observer) => {
                    if (entries[0].isIntersecting) {
                        observer.disconnect();
                        loadMore();
                    }
                }, { rootMargin: '400px' }).observe(link);
            };

            observeLoadMore();
        })();
    </script>
@endpush
