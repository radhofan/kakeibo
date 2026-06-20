<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trim($__env->yieldContent('title', 'Kakeibo Anime')) }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        @livewireStyles
    </head>
    <body class="bg-zinc-950 text-white antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-40 border-b border-white/10 bg-zinc-950/90 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6">
                    <a href="{{ route('landing') }}" class="flex items-center gap-3">
                        <span class="grid h-9 w-9 place-items-center rounded-md bg-rose-600 font-black">K</span>
                        <span class="text-lg font-black tracking-wide">Kakeibo Anime</span>
                    </a>

                    <nav class="hidden items-center gap-1 lg:flex">
                        <a href="{{ route('discover') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('discover') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">Discover</a>
                        <a href="{{ route('seasonal') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('seasonal') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">Seasonal</a>
                        <a href="{{ route('top-anime') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('top-anime') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">Top Anime</a>
                        <a href="{{ route('reviews.index') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('reviews.*') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">Reviews</a>
                        @auth
                            <a href="{{ route('library.index') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('library.*') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">My Library</a>
                            <a href="{{ route('activity.index') }}" class="rounded-md px-3 py-2 text-sm font-semibold {{ request()->routeIs('activity.*') ? 'bg-white/10' : 'text-zinc-300 hover:bg-white/10' }}">Activity</a>
                        @endauth
                    </nav>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('search') }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-semibold text-zinc-200">Search</a>
                        @guest
                            <a href="{{ route('login') }}" class="hidden rounded-md px-3 py-2 text-sm font-semibold text-zinc-200 sm:block">Sign In</a>
                            <a href="{{ route('register') }}" class="rounded-md bg-white px-3 py-2 text-sm font-bold text-zinc-950">Create Account</a>
                        @else
                            <a href="{{ route('notifications.index') }}" class="rounded-md border border-white/10 px-3 py-2 text-sm font-semibold">Notifications</a>
                            <a href="{{ route('profiles.show', auth()->user()) }}" class="hidden items-center gap-2 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold sm:flex">
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->public_name }} avatar" class="h-6 w-6 rounded-full">
                                {{ auth()->user()->username }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-md px-3 py-2 text-sm font-semibold text-zinc-300">Sign Out</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </header>

            @if (session('status'))
                <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6">
                    <div class="rounded-md border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm font-semibold text-emerald-100">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <main>
                {{ $slot ?? '' }}
                @yield('content')
            </main>

            <nav class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-5 border-t border-white/10 bg-zinc-950/95 text-center text-xs font-semibold text-zinc-300 lg:hidden">
                <a class="py-3" href="{{ route('landing') }}">Home</a>
                <a class="py-3" href="{{ route('discover') }}">Discover</a>
                <a class="py-3" href="{{ route('search') }}">Search</a>
                @auth
                    <a class="py-3" href="{{ route('library.index') }}">Library</a>
                    <a class="py-3" href="{{ route('profiles.show', auth()->user()) }}">Account</a>
                @else
                    <a class="py-3" href="{{ route('reviews.index') }}">Reviews</a>
                    <a class="py-3" href="{{ route('login') }}">Account</a>
                @endauth
            </nav>
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
