@extends('layouts.app')

@section('title', $profile->public_name.' Lists')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">{{ $profile->public_name }} Lists</h1>
        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($lists as $list)
                <a href="{{ route('lists.show', $list) }}" class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <h2 class="text-xl font-black">{{ $list->title }}</h2>
                    <p class="mt-2 text-sm text-zinc-400">{{ $list->entries->count() }} anime · {{ $list->visibility }}</p>
                    <p class="mt-2 text-zinc-300">{{ $list->description }}</p>
                </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $lists->links() }}</div>
    </section>
@endsection
