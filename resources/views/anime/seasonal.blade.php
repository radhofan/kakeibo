@extends('layouts.app')

@section('title', 'Seasonal Anime')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-4xl font-black">Seasonal Anime</h1>
                <p class="mt-2 text-zinc-400">Browse {{ ucfirst($season) }} {{ $year }} by format.</p>
            </div>
            <form class="flex gap-2">
                <select name="season" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                    @foreach (['winter', 'spring', 'summer', 'fall'] as $option)
                        <option value="{{ $option }}" @selected($season === $option)>{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
                <input name="year" value="{{ $year }}" class="w-28 rounded-md border border-white/10 bg-zinc-900 px-3 py-2 text-sm">
                <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Go</button>
            </form>
        </div>

        <div class="space-y-10">
            @forelse ($groups as $format => $items)
                <section>
                    <h2 class="mb-4 text-2xl font-black">{{ $format }}</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($items as $anime)
                            <x-anime-card :anime="$anime" />
                        @endforeach
                    </div>
                </section>
            @empty
                <x-empty-state title="No seasonal anime are cached for this season." action="Open Discover" :href="route('discover')" />
            @endforelse
        </div>
    </section>
@endsection
