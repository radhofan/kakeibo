@props(['anime'])

<article class="group overflow-hidden rounded-lg border border-white/10 bg-white/[0.04]">
    <a href="{{ route('anime.show', $anime) }}" class="block">
        <div class="aspect-[3/4] overflow-hidden bg-zinc-800">
            @if ($anime->cover_image_url)
                <img src="{{ $anime->cover_image_url }}" alt="{{ $anime->preferred_display_title }} cover" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
            @else
                <div class="grid h-full place-items-center px-4 text-center text-sm text-zinc-400">No cover available</div>
            @endif
        </div>
        <div class="space-y-2 p-3">
            <h3 class="line-clamp-2 min-h-10 text-sm font-bold">{{ $anime->preferred_display_title }}</h3>
            <div class="flex flex-wrap gap-2 text-xs text-zinc-300">
                <span class="rounded bg-amber-300 px-2 py-1 font-bold text-zinc-950">{{ $anime->average_score ?: '--' }}</span>
                <span>{{ $anime->season_year ?: 'TBA' }}</span>
                <span>{{ $anime->format ?: 'Anime' }}</span>
            </div>
            <div class="flex flex-wrap gap-1">
                @foreach ($anime->genres->take(2) as $genre)
                    <span class="rounded border border-white/10 px-2 py-1 text-xs text-zinc-300">{{ $genre->name }}</span>
                @endforeach
            </div>
        </div>
    </a>
    <div class="border-t border-white/10 p-3">
        @livewire('library-status-selector', ['anime' => $anime], key('card-'.$anime->id))
    </div>
</article>
