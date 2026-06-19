<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function profile()
    {
        return view('settings.profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'display_name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'alpha_dash', 'max:60', 'unique:users,username,'.$request->user()->id],
            'bio' => ['nullable', 'string', 'max:600'],
            'location' => ['nullable', 'string', 'max:120'],
            'avatar_url' => ['nullable', 'url'],
            'banner_url' => ['nullable', 'url'],
            'preferred_title_language' => ['required', 'in:romaji,english,native'],
        ]);

        $request->user()->update($data + ['name' => $data['display_name']]);

        return back()->with('status', 'Profile settings saved.');
    }

    public function privacy()
    {
        return view('settings.privacy');
    }

    public function updatePrivacy(Request $request)
    {
        $request->user()->update($request->validate([
            'profile_visibility' => ['required', 'in:public,followers,private'],
            'library_visibility' => ['required', 'in:public,followers,private'],
            'activity_visibility' => ['required', 'in:public,followers,private'],
        ]));

        return back()->with('status', 'Privacy settings saved.');
    }

    public function notifications()
    {
        return view('settings.notifications');
    }

    public function updateNotifications(Request $request)
    {
        $request->user()->update([
            'notification_preferences' => [
                'followers' => $request->boolean('followers'),
                'review_likes' => $request->boolean('review_likes'),
                'comments' => $request->boolean('comments'),
                'lists' => $request->boolean('lists'),
                'email' => $request->boolean('email'),
            ],
        ]);

        return back()->with('status', 'Notification settings saved.');
    }

    public function account()
    {
        return view('settings.account', ['exportToken' => Str::random(24)]);
    }

    public function updateAccount(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'email' => $data['email'],
            ...($request->filled('password') ? ['password' => Hash::make($data['password'])] : []),
        ]);

        return back()->with('status', 'Account settings saved.');
    }

    public function export(Request $request)
    {
        $user = $request->user()->load(['libraryEntries.anime', 'reviews.anime', 'customLists.entries.anime']);

        return response()->json([
            'profile' => $user->only(['display_name', 'username', 'email', 'bio', 'location']),
            'library' => $user->libraryEntries,
            'reviews' => $user->reviews,
            'lists' => $user->customLists,
        ]);
    }

    public function destroyAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'in:DELETE MY ACCOUNT'],
        ]);

        $user = $request->user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();

        return redirect()->route('landing')->with('status', 'Account deleted.');
    }
}
