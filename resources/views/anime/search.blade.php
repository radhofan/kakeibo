@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Search</h1>
        <form class="mt-5 flex gap-2">
            <input name="q" value="{{ $query }}" placeholder="Search anime, users, lists, or reviews" class="min-w-0 flex-1 rounded-md border border-white/10 bg-zinc-900 px-4 py-3">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Search</button>
        </form>

        <div class="my-6 flex flex-wrap gap-2">
            @foreach (['anime' => 'Anime', 'users' => 'Users', 'lists' => 'Lists', 'reviews' => 'Reviews'] as $value => $label)
                <a href="{{ route('search', ['q' => $query, 'tab' => $value]) }}" class="rounded-md px-4 py-2 text-sm font-bold {{ $tab === $value ? 'bg-white text-zinc-950' : 'border border-white/10 text-zinc-300' }}">{{ $label }}</a>
            @endforeach
        </div>

        @if ($apiWarning)
            <div class="mb-6 rounded-md border border-amber-300/30 bg-amber-300/10 px-4 py-3 text-sm text-amber-100">{{ $apiWarning }}</div>
        @endif

        @if ($tab === 'anime')
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($anime as $item)
                    <x-anime-card :anime="$item" />
                @empty
                    <x-empty-state title="No anime results." action="Browse Discover" :href="route('discover')" />
                @endforelse
            </div>
            <div class="mt-8">{{ $anime->links() }}</div>
        @elseif ($tab === 'users')
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($users as $user)
                    <a href="{{ route('profiles.show', $user) }}" class="flex items-center gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->public_name }} avatar" class="h-14 w-14 rounded-full">
                        <div>
                            <p class="font-black">{{ $user->public_name }}</p>
                            <p class="text-sm text-zinc-400">{{ '@'.$user->username }} · {{ $user->followers()->count() }} followers</p>
                            <p class="mt-1 line-clamp-2 text-sm text-zinc-300">{{ $user->bio }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @elseif ($tab === 'lists')
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($lists as $list)
                    <a href="{{ route('lists.show', $list) }}" class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                        <p class="font-black">{{ $list->title }}</p>
                        <p class="text-sm text-zinc-400">by {{ $list->user->public_name }} · {{ $list->entries->count() }} anime · {{ $list->visibility }}</p>
                        <p class="mt-2 line-clamp-2 text-sm text-zinc-300">{{ $list->description }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="space-y-4">
                @foreach ($reviews as $review)
                    <x-review-card :review="$review" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
