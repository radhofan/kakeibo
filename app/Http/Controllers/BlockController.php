<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    public function store(Request $request, User $user)
    {
        abort_if($request->user()->is($user), 422, 'You cannot block yourself.');

        DB::table('blocks')->updateOrInsert([
            'blocker_user_id' => $request->user()->id,
            'blocked_user_id' => $user->id,
        ], ['created_at' => now(), 'updated_at' => now()]);

        $request->user()->following()->detach($user->id);
        $user->following()->detach($request->user()->id);

        return back()->with('status', 'User blocked.');
    }

    public function destroy(Request $request, User $user)
    {
        DB::table('blocks')
            ->where('blocker_user_id', $request->user()->id)
            ->where('blocked_user_id', $user->id)
            ->delete();

        return back()->with('status', 'User unblocked.');
    }
}
