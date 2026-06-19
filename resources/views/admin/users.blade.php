@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">User Moderation</h1>
        @include('admin.partials.nav')
        <div class="space-y-3">
            @foreach ($users as $user)
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-4 md:grid-cols-[1fr_150px_150px_1fr_auto] md:items-center">
                    @csrf @method('PATCH')
                    <div><p class="font-black">{{ $user->public_name }}</p><p class="text-sm text-zinc-400">{{ $user->email }} · {{ '@'.$user->username }}</p></div>
                    <select name="account_status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">@foreach(['active','suspended'] as $status)<option value="{{ $status }}" @selected($user->account_status === $status)>{{ $status }}</option>@endforeach</select>
                    <select name="role" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">@foreach(['member','admin'] as $role)<option value="{{ $role }}" @selected($user->role === $role)>{{ $role }}</option>@endforeach</select>
                    <input name="reason" placeholder="Reason" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Save</button>
                </form>
            @endforeach
        </div>
        <div class="mt-8">{{ $users->links() }}</div>
    </section>
@endsection
