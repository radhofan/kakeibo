@extends('layouts.app')

@section('title', $review->headline)

@section('content')
    <article class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex gap-4">
            <img src="{{ $review->anime->cover_image_url }}" alt="{{ $review->anime->preferred_display_title }} cover" class="h-40 w-28 rounded object-cover">
            <div>
                <p class="text-sm text-zinc-400">Review for <a class="text-white" href="{{ route('anime.show', $review->anime) }}">{{ $review->anime->preferred_display_title }}</a></p>
                <h1 class="mt-2 text-4xl font-black">{{ $review->headline }}</h1>
                <p class="mt-3 text-zinc-400">by <a class="text-white" href="{{ route('profiles.show', $review->user) }}">{{ $review->user->public_name }}</a> · {{ $review->score }}/100</p>
            </div>
        </div>

        @if ($review->contains_spoilers)
            <div class="mb-6 rounded-lg border border-amber-300/40 bg-amber-300/10 p-4 text-amber-100">This review contains spoilers.</div>
        @endif

        <div class="prose prose-invert max-w-none rounded-lg border border-white/10 bg-white/[0.04] p-6 leading-8">
            {!! nl2br(e($review->body)) !!}
        </div>

        <div class="mt-6 flex gap-3">
            @auth
                <form method="POST" action="{{ route('reviews.like', $review) }}">@csrf<button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Like</button></form>
                <a href="{{ route('reports.create', ['type' => 'review', 'id' => $review->id]) }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                @if ($review->user_id === auth()->id())
                    <a href="{{ route('reviews.edit', $review) }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Edit</a>
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" onsubmit="return confirm('Delete this review?')">@csrf @method('DELETE')<button class="rounded-md border border-rose-400/40 px-4 py-2 text-sm font-bold text-rose-200">Delete</button></form>
                @endif
            @endauth
        </div>

        <section class="mt-10">
            <h2 class="text-2xl font-black">Comments</h2>
            <div class="mt-4 space-y-3">
                @forelse ($review->comments as $comment)
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                        <p class="text-sm font-bold">{{ $comment->user->public_name }}</p>
                        <p class="mt-2 text-zinc-300">{{ $comment->body }}</p>
                        @auth
                            <div class="mt-3 flex gap-2">
                                <form method="POST" action="{{ route('comments.like', $comment) }}">@csrf<button class="text-sm font-bold text-rose-300">Like</button></form>
                                <a href="{{ route('reports.create', ['type' => 'comment', 'id' => $comment->id]) }}" class="text-sm font-bold text-zinc-300">Report</a>
                                @if ($comment->user_id === auth()->id())
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" onsubmit="return confirm('Delete this comment?')">@csrf @method('DELETE')<button class="text-sm font-bold text-rose-200">Delete</button></form>
                                @endif
                            </div>
                        @endauth
                    </div>
                @empty
                    <p class="text-sm text-zinc-400">No comments yet.</p>
                @endforelse
            </div>
            @auth
                <form method="POST" action="{{ route('comments.store', $review) }}" class="mt-5 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    @csrf
                    <label class="block"><span class="text-sm font-bold">Add comment</span><textarea name="body" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></textarea></label>
                    <button class="mt-3 rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Publish Comment</button>
                </form>
            @endauth
        </section>
    </article>
@endsection
