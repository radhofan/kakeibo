<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __invoke(Request $request)
    {
        $tab = $request->get('tab', 'global');
        $followingIds = $request->user()->following()->pluck('users.id');

        return view('activity.index', [
            'tab' => $tab,
            'activities' => Activity::with('user')
                ->when($tab === 'mine', fn ($query) => $query->where('user_id', $request->user()->id))
                ->when($tab === 'following', fn ($query) => $query->whereIn('user_id', $followingIds))
                ->latest()
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
}
