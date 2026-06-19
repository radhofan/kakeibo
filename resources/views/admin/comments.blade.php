@extends('layouts.app')

@section('title', 'Admin Comments')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Comment Moderation</h1>
        @include('admin.partials.nav')
        <div class="space-y-3">
            @foreach ($comments as $comment)
                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-4 md:grid-cols-[1fr_180px_auto] md:items-center">
                    @csrf @method('PATCH')
                    <div><p class="font-black">{{ $comment->user->public_name }}</p><p class="text-sm text-zinc-400">{{ Str::limit($comment->body, 120) }}</p></div>
                    <select name="moderation_status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">@foreach(['visible','hidden','deleted'] as $status)<option value="{{ $status }}" @selected($comment->moderation_status === $status)>{{ $status }}</option>@endforeach</select>
                    <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Save</button>
                </form>
            @endforeach
        </div>
        <div class="mt-8">{{ $comments->links() }}</div>
    </section>
@endsection
