@extends('layouts.app')

@section('title', $profile->public_name)

@section('content')
    <section class="relative">
        <div class="h-56 bg-zinc-800">
            @if ($profile->banner_url)
                <img src="{{ $profile->banner_url }}" alt="{{ $profile->public_name }} banner" class="h-full w-full object-cover">
            @endif
        </div>
        <div class="mx-auto max-w-7xl px-4 pb-10 sm:px-6">
            <div class="-mt-16 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div class="flex items-end gap-5">
                    <img src="{{ $profile->avatar_url }}" alt="{{ $profile->public_name }} avatar" class="h-32 w-32 rounded-lg border-4 border-zinc-950 bg-zinc-900 object-cover">
                    <div>
                        <h1 class="text-4xl font-black">{{ $profile->public_name }}</h1>
                        <p class="text-zinc-400">{{ '@'.$profile->username }} · {{ $profile->followers_count }} followers · {{ $profile->following_count }} following</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    @auth
                        @if (auth()->id() === $profile->id)
                            <a href="{{ route('settings.profile') }}" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Edit Profile</a>
                        @else
                            <form method="POST" action="{{ route('profiles.follow', $profile) }}">@csrf<button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Follow</button></form>
                            <form method="POST" action="{{ route('profiles.block', $profile) }}">@csrf<button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Block</button></form>
                            <a href="{{ route('reports.create', ['type' => 'user', 'id' => $profile->id]) }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                        @endif
                    @endauth
                </div>
            </div>
            <p class="mt-6 max-w-3xl text-zinc-300">{{ $profile->bio }}</p>
            <div class="mt-6 flex flex-wrap gap-2">
                <a href="{{ route('profiles.show', $profile) }}" class="rounded-md bg-white text-zinc-950 px-3 py-2 text-sm font-bold">Overview</a>
                <a href="{{ route('profiles.library', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Library</a>
                <a href="{{ route('profiles.reviews', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Reviews</a>
                <a href="{{ route('profiles.lists', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Lists</a>
                <a href="{{ route('profiles.activity', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Activity</a>
                <a href="{{ route('profiles.followers', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Followers</a>
                <a href="{{ route('profiles.following', $profile) }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-bold">Following</a>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-12 sm:px-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <h2 class="mb-4 text-2xl font-black">Recently Watched</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($profile->libraryEntries->take(4) as $entry)
                    <x-anime-card :anime="$entry->anime" />
                @endforeach
            </div>
        </div>
        <aside>
            <h2 class="mb-4 text-2xl font-black">Recent Reviews</h2>
            <div class="space-y-4">
                @foreach ($profile->reviews->take(3) as $review)
                    <x-review-card :review="$review" />
                @endforeach
            </div>
        </aside>
    </section>
@endsection
