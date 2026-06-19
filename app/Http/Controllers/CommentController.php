<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Review;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Review $review)
    {
        abort_unless($review->comments_enabled, 403);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:1200'],
            'parent_comment_id' => ['nullable', 'exists:comments,id'],
        ]);

        $comment = $review->comments()->create($data + [
            'user_id' => $request->user()->id,
            'moderation_status' => 'visible',
        ]);

        if ($review->user_id !== $request->user()->id) {
            AppNotification::create([
                'user_id' => $review->user_id,
                'notification_type' => 'review_commented',
                'actor_user_id' => $request->user()->id,
                'subject_type' => Comment::class,
                'subject_id' => $comment->id,
                'data' => ['message' => $request->user()->public_name.' commented on your review.'],
            ]);
        }

        return back()->with('status', 'Comment published.');
    }

    public function update(Request $request, Comment $comment)
    {
        abort_unless($comment->user_id === $request->user()->id, 403);

        $comment->update($request->validate(['body' => ['required', 'string', 'max:1200']]));

        return back()->with('status', 'Comment updated.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        abort_unless($comment->user_id === $request->user()->id || $request->user()->role === 'admin', 403);

        $comment->delete();

        return back()->with('status', 'Comment deleted.');
    }

    public function like(Request $request, Comment $comment)
    {
        CommentLike::firstOrCreate(['user_id' => $request->user()->id, 'comment_id' => $comment->id]);

        return back()->with('status', 'Comment liked.');
    }
}
