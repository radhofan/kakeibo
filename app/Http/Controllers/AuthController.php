<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            return back()->withErrors(['login' => 'Invalid email, username, or password.'])->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'display_name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'alpha_dash', 'max:60', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $data['display_name'],
            'display_name' => $data['display_name'],
            'username' => Str::lower($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar_url' => 'https://api.dicebear.com/8.x/initials/svg?seed='.urlencode($data['display_name']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
