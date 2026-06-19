@props(['review'])

<article class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
    <div class="flex gap-4">
        <img src="{{ $review->anime->cover_image_url }}" alt="{{ $review->anime->preferred_display_title }} cover" class="h-24 w-16 rounded-md object-cover">
        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2 text-xs text-zinc-400">
                <img src="{{ $review->user->avatar_url }}" alt="{{ $review->user->public_name }} avatar" class="h-6 w-6 rounded-full">
                <a href="{{ route('profiles.show', $review->user) }}" class="font-semibold text-white">{{ $review->user->public_name }}</a>
                <span>reviewed</span>
                <a href="{{ route('anime.show', $review->anime) }}" class="font-semibold text-white">{{ $review->anime->preferred_display_title }}</a>
            </div>
            <h3 class="mt-2 text-lg font-black"><a href="{{ route('reviews.show', $review) }}">{{ $review->headline }}</a></h3>
            <div class="mt-2 flex flex-wrap gap-2 text-xs font-semibold">
                <span class="rounded bg-rose-600 px-2 py-1 text-white">{{ $review->score }}/100</span>
                @if ($review->contains_spoilers)
                    <span class="rounded bg-amber-300 px-2 py-1 text-zinc-950">Spoilers</span>
                @endif
                <span class="text-zinc-400">{{ $review->likes->count() }} likes</span>
                <span class="text-zinc-400">{{ $review->comments->count() }} comments</span>
            </div>
            <p class="mt-3 line-clamp-3 text-sm leading-6 text-zinc-300">{{ $review->body }}</p>
        </div>
    </div>
</article>
