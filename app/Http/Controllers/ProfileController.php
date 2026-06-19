<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        abort_if($user->profile_visibility === 'private' && auth()->id() !== $user->id, 403);

        $user->loadCount(['followers', 'following'])
            ->load(['libraryEntries.anime', 'reviews.anime', 'customLists.entries.anime', 'activities']);

        return view('profiles.show', ['profile' => $user]);
    }

    public function library(User $user)
    {
        abort_if($user->library_visibility === 'private' && auth()->id() !== $user->id, 403);

        return view('profiles.library', [
            'profile' => $user,
            'entries' => $user->libraryEntries()->with('anime.genres')->where('visibility', 'public')->paginate(12),
        ]);
    }

    public function reviews(User $user)
    {
        return view('profiles.reviews', [
            'profile' => $user,
            'reviews' => $user->reviews()->with('anime')->where('publication_status', 'published')->paginate(10),
        ]);
    }

    public function lists(User $user)
    {
        return view('profiles.lists', [
            'profile' => $user,
            'lists' => $user->customLists()->with('entries.anime')->where('visibility', 'public')->paginate(10),
        ]);
    }

    public function activity(User $user)
    {
        abort_if($user->activity_visibility === 'private' && auth()->id() !== $user->id, 403);

        return view('profiles.activity', [
            'profile' => $user,
            'activities' => $user->activities()->latest()->paginate(15),
        ]);
    }

    public function followers(User $user)
    {
        return view('profiles.people', [
            'profile' => $user,
            'title' => 'Followers',
            'people' => $user->followers()->paginate(20),
        ]);
    }

    public function following(User $user)
    {
        return view('profiles.people', [
            'profile' => $user,
            'title' => 'Following',
            'people' => $user->following()->paginate(20),
        ]);
    }

    public function follow(Request $request, User $user)
    {
        abort_if($request->user()->is($user), 422, 'You cannot follow yourself.');
        abort_if(DB::table('blocks')
            ->where(fn ($query) => $query
                ->where('blocker_user_id', $request->user()->id)
                ->where('blocked_user_id', $user->id))
            ->orWhere(fn ($query) => $query
                ->where('blocker_user_id', $user->id)
                ->where('blocked_user_id', $request->user()->id))
            ->exists(), 403, 'Blocked users cannot follow each other.');

        $request->user()->following()->syncWithoutDetaching([$user->id]);

        \App\Models\AppNotification::create([
            'user_id' => $user->id,
            'notification_type' => 'new_follower',
            'actor_user_id' => $request->user()->id,
            'data' => ['message' => $request->user()->public_name.' followed you.'],
        ]);

        return back()->with('status', 'You are now following '.$user->public_name.'.');
    }

    public function unfollow(Request $request, User $user)
    {
        $request->user()->following()->detach($user->id);

        return back()->with('status', 'You unfollowed '.$user->public_name.'.');
    }
}
