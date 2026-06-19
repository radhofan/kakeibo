<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Review;
use App\Models\ReviewLike;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with(['user', 'anime', 'likes', 'comments'])
            ->where('publication_status', 'published')
            ->where('moderation_status', 'visible')
            ->when($request->filled('q'), fn ($query) => $query->where('headline', 'like', '%'.$request->q.'%'))
            ->when($request->get('sort') === 'liked', fn ($query) => $query->withCount('likes')->orderByDesc('likes_count'))
            ->when($request->get('sort') === 'score', fn ($query) => $query->orderByDesc('score'))
            ->when(! $request->filled('sort') || $request->get('sort') === 'newest', fn ($query) => $query->latest('published_at'))
            ->paginate(10)
            ->withQueryString();

        return view('reviews.index', ['reviews' => $reviews]);
    }

    public function show(Review $review)
    {
        abort_unless($review->publication_status === 'published' && $review->moderation_status === 'visible' || auth()->id() === $review->user_id || auth()->user()?->role === 'admin', 404);

        $review->load(['user', 'anime', 'likes', 'comments.user', 'comments.likes']);

        return view('reviews.show', ['review' => $review]);
    }

    public function create(Anime $anime)
    {
        $review = auth()->user()->reviews()->where('anime_id', $anime->id)->first();

        return view('reviews.form', ['anime' => $anime, 'review' => $review]);
    }

    public function store(Request $request, Anime $anime)
    {
        $data = $request->validate([
            'headline' => ['required', 'string', 'max:160'],
            'body' => ['required', 'string', 'min:40'],
            'score' => ['required', 'integer', 'min:1', 'max:100'],
            'contains_spoilers' => ['nullable', 'boolean'],
            'comments_enabled' => ['nullable', 'boolean'],
            'publication_status' => ['required', 'in:draft,published'],
        ]);

        $review = Review::updateOrCreate(
            ['user_id' => $request->user()->id, 'anime_id' => $anime->id, 'publication_status' => $data['publication_status']],
            $data + [
                'contains_spoilers' => $request->boolean('contains_spoilers'),
                'comments_enabled' => $request->boolean('comments_enabled', true),
                'published_at' => $data['publication_status'] === 'published' ? now() : null,
                'moderation_status' => 'visible',
            ],
        );

        return redirect()->route('reviews.show', $review)->with('status', 'Review saved.');
    }

    public function edit(Review $review)
    {
        abort_unless($review->user_id === auth()->id(), 403);

        return view('reviews.form', ['anime' => $review->anime, 'review' => $review]);
    }

    public function update(Request $request, Review $review)
    {
        abort_unless($review->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'headline' => ['required', 'string', 'max:160'],
            'body' => ['required', 'string', 'min:40'],
            'score' => ['required', 'integer', 'min:1', 'max:100'],
            'contains_spoilers' => ['nullable', 'boolean'],
            'comments_enabled' => ['nullable', 'boolean'],
        ]);

        $review->update($data + [
            'contains_spoilers' => $request->boolean('contains_spoilers'),
            'comments_enabled' => $request->boolean('comments_enabled', true),
            'edited_at' => now(),
        ]);

        return redirect()->route('reviews.show', $review)->with('status', 'Review updated.');
    }

    public function like(Request $request, Review $review)
    {
        $like = ReviewLike::where(['user_id' => $request->user()->id, 'review_id' => $review->id])->first();

        if ($like) {
            $like->delete();

            return back()->with('status', 'Review unliked.');
        }

        ReviewLike::create(['user_id' => $request->user()->id, 'review_id' => $review->id]);

        return back()->with('status', 'Review liked.');
    }

    public function destroy(Request $request, Review $review)
    {
        abort_unless($review->user_id === $request->user()->id || $request->user()->role === 'admin', 403);

        $review->delete();

        return redirect()->route('reviews.index')->with('status', 'Review deleted.');
    }
}
