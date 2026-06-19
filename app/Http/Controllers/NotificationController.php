<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return view('notifications.index', [
            'notifications' => AppNotification::with('actor')
                ->where('user_id', $request->user()->id)
                ->latest()
                ->paginate(20),
        ]);
    }

    public function markAllRead(Request $request)
    {
        AppNotification::where('user_id', $request->user()->id)->update(['read_at' => now()]);

        return back()->with('status', 'Notifications marked as read.');
    }

    public function markRead(Request $request, AppNotification $notification)
    {
        abort_unless($notification->user_id === $request->user()->id, 403);

        $notification->update(['read_at' => now()]);

        return back()->with('status', 'Notification marked as read.');
    }

    public function destroy(Request $request, AppNotification $notification)
    {
        abort_unless($notification->user_id === $request->user()->id, 403);

        $notification->delete();

        return back()->with('status', 'Notification deleted.');
    }
}
