<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\ModerationAction;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use App\Services\AnimeCatalogService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function authorizeAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index()
    {
        $this->authorizeAdmin();

        return view('admin.index', [
            'users' => User::count(),
            'activeUsers' => User::where('account_status', 'active')->count(),
            'reviews' => Review::where('publication_status', 'published')->count(),
            'comments' => Comment::count(),
            'reports' => Report::where('status', 'open')->count(),
            'anime' => Anime::count(),
            'recentReports' => Report::latest()->take(8)->get(),
        ]);
    }

    public function users()
    {
        $this->authorizeAdmin();

        return view('admin.users', ['users' => User::latest()->paginate(20)]);
    }

    public function updateUser(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'account_status' => ['required', 'in:active,suspended'],
            'role' => ['required', 'in:member,admin'],
            'reason' => ['nullable', 'string', 'max:600'],
        ]);

        $user->update([
            'account_status' => $data['account_status'],
            'role' => $data['role'],
        ]);
        ModerationAction::create([
            'moderator_user_id' => $request->user()->id,
            'target_user_id' => $user->id,
            'action_type' => 'user_'.$data['account_status'],
            'reason' => $data['reason'],
        ]);

        return back()->with('status', 'User moderation action saved.');
    }

    public function reviews()
    {
        $this->authorizeAdmin();

        return view('admin.reviews', ['reviews' => Review::with(['user', 'anime'])->latest()->paginate(20)]);
    }

    public function updateReview(Request $request, Review $review)
    {
        $this->authorizeAdmin();

        $review->update($request->validate(['moderation_status' => ['required', 'in:visible,hidden,deleted']]));

        return back()->with('status', 'Review moderation status saved.');
    }

    public function comments()
    {
        $this->authorizeAdmin();

        return view('admin.comments', ['comments' => Comment::with(['user'])->latest()->paginate(20)]);
    }

    public function updateComment(Request $request, Comment $comment)
    {
        $this->authorizeAdmin();

        $comment->update($request->validate(['moderation_status' => ['required', 'in:visible,hidden,deleted']]));

        return back()->with('status', 'Comment moderation status saved.');
    }

    public function reports()
    {
        $this->authorizeAdmin();

        return view('admin.reports', ['reports' => Report::latest()->paginate(20)]);
    }

    public function updateReport(Request $request, Report $report)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'status' => ['required', 'in:open,investigating,resolved,dismissed'],
            'resolution_note' => ['nullable', 'string', 'max:1200'],
        ]);

        $report->update($data + [
            'assigned_moderator_id' => $request->user()->id,
            'resolved_at' => in_array($data['status'], ['resolved', 'dismissed'], true) ? now() : null,
        ]);

        return back()->with('status', 'Report updated.');
    }

    public function animeCache()
    {
        $this->authorizeAdmin();

        return view('admin.anime-cache', ['anime' => Anime::latest('metadata_last_synced_at')->paginate(20)]);
    }

    public function refreshAnime(Request $request, AnimeCatalogService $catalog)
    {
        $this->authorizeAdmin();

        $data = $request->validate(['search' => ['required', 'string', 'max:120']]);
        $cached = $catalog->searchAndCache($data['search']);

        return back()->with('status', count($cached).' anime records refreshed from AniList.');
    }
}
