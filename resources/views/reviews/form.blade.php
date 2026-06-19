@extends('layouts.app')

@section('title', $review->exists ? 'Edit Review' : 'Write Review')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex gap-4">
            <img src="{{ $anime->cover_image_url }}" alt="{{ $anime->preferred_display_title }} cover" class="h-32 w-24 rounded object-cover">
            <div>
                <h1 class="text-4xl font-black">{{ $review->exists ? 'Edit Review' : 'Write Review' }}</h1>
                <p class="mt-2 text-zinc-400">{{ $anime->preferred_display_title }}</p>
            </div>
        </div>
        <form method="POST" action="{{ $review->exists ? route('reviews.update', $review) : route('reviews.store', $anime) }}" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf
            @if ($review->exists) @method('PATCH') @endif
            <label class="block"><span class="text-sm font-bold">Headline</span><input name="headline" value="{{ old('headline', $review->headline) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Body</span><textarea name="body" rows="10" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">{{ old('body', $review->body) }}</textarea></label>
            <label class="block"><span class="text-sm font-bold">Score</span><input name="score" value="{{ old('score', $review->score) }}" type="number" min="1" max="100" class="mt-1 w-32 rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <div class="flex flex-wrap gap-5 text-sm">
                <label><input name="contains_spoilers" value="1" type="checkbox" @checked(old('contains_spoilers', $review->contains_spoilers))> Contains spoilers</label>
                <label><input name="comments_enabled" value="1" type="checkbox" @checked(old('comments_enabled', $review->comments_enabled ?? true))> Allow comments</label>
            </div>
            @unless ($review->exists)
                <select name="publication_status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <option value="published">Publish Review</option>
                    <option value="draft">Save Draft</option>
                </select>
            @endunless
            @if ($errors->any())
                <div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100">{{ $errors->first() }}</div>
            @endif
            <div class="flex gap-3">
                <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">{{ $review->exists ? 'Save Changes' : 'Publish Review' }}</button>
                <a href="{{ route('anime.show', $anime) }}" class="rounded-md border border-white/10 px-5 py-3 text-sm font-bold">Cancel</a>
            </div>
        </form>
    </section>
@endsection
