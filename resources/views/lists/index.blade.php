@extends('layouts.app')

@section('title', 'My Lists')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-6 flex items-end justify-between">
            <div><h1 class="text-4xl font-black">My Lists</h1><p class="mt-2 text-zinc-400">Create recommendations, favorites, and watch queues.</p></div>
            <a href="{{ route('lists.create') }}" class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Create List</a>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($lists as $list)
                <a href="{{ route('lists.show', $list) }}" class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <h2 class="text-xl font-black">{{ $list->title }}</h2>
                    <p class="mt-2 text-sm text-zinc-400">{{ $list->entries->count() }} anime · {{ $list->visibility }} · updated {{ $list->updated_at->diffForHumans() }}</p>
                    <p class="mt-2 text-zinc-300">{{ $list->description }}</p>
                </a>
            @empty
                <x-empty-state title="Create a list for favorites, recommendations, or anything else." action="Create List" :href="route('lists.create')" />
            @endforelse
        </div>
    </section>
@endsection
