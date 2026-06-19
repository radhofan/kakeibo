@extends('layouts.app')

@section('title', $list->title)

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm text-zinc-400">List by <a class="text-white" href="{{ route('profiles.show', $list->user) }}">{{ $list->user->public_name }}</a></p>
                <h1 class="text-4xl font-black">{{ $list->title }}</h1>
                <p class="mt-3 max-w-3xl text-zinc-300">{{ $list->description }}</p>
            </div>
            @auth
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('lists.like', $list) }}">@csrf<button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Like {{ $list->likes->count() }}</button></form>
                    <form method="POST" action="{{ route('lists.save', $list) }}">@csrf<button class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Save {{ $list->saves->count() }}</button></form>
                    <a href="{{ route('reports.create', ['type' => 'list', 'id' => $list->id]) }}" class="rounded-md border border-white/10 px-4 py-2 text-sm font-bold">Report</a>
                </div>
                @if ($list->user_id === auth()->id())
                    <div class="flex gap-2">
                        <a href="{{ route('lists.edit', $list) }}" class="rounded-md bg-white px-4 py-2 text-sm font-black text-zinc-950">Edit List</a>
                        <form method="POST" action="{{ route('lists.destroy', $list) }}" onsubmit="return confirm('Delete this list?')">@csrf @method('DELETE')<button class="rounded-md border border-rose-400/40 px-4 py-2 text-sm font-bold text-rose-200">Delete</button></form>
                    </div>
                @endif
            @endauth
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($list->entries as $entry)
                <article class="rounded-lg border border-white/10 bg-white/[0.04]">
                    <x-anime-card :anime="$entry->anime" />
                    @if ($entry->note)
                        <p class="border-t border-white/10 p-3 text-sm text-zinc-300">{{ $entry->note }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
@endsection
