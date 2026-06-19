@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <div class="mb-6 flex items-end justify-between">
            <h1 class="text-4xl font-black">Notifications</h1>
            <form method="POST" action="{{ route('notifications.read') }}">@csrf @method('PATCH')<button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Mark all read</button></form>
        </div>
        <div class="space-y-3">
            @forelse ($notifications as $notification)
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4 {{ $notification->read_at ? 'opacity-70' : '' }}">
                    <p class="font-bold">{{ str_replace('_', ' ', $notification->notification_type) }}</p>
                    <p class="mt-1 text-sm text-zinc-400">{{ $notification->data['message'] ?? 'New account activity.' }}</p>
                    <div class="mt-3 flex gap-2">
                        <form method="POST" action="{{ route('notifications.item.read', $notification) }}">@csrf @method('PATCH')<button class="text-sm font-bold text-rose-300">Mark read</button></form>
                        <form method="POST" action="{{ route('notifications.destroy', $notification) }}">@csrf @method('DELETE')<button class="text-sm font-bold text-zinc-300">Delete</button></form>
                    </div>
                </div>
            @empty
                <x-empty-state title="No notifications yet." />
            @endforelse
        </div>
        <div class="mt-8">{{ $notifications->links() }}</div>
    </section>
@endsection
