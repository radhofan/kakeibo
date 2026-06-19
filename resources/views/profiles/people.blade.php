@extends('layouts.app')

@section('title', $profile->public_name.' '.$title)

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">{{ $profile->public_name }} {{ $title }}</h1>
        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($people as $person)
                <a href="{{ route('profiles.show', $person) }}" class="flex gap-4 rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <img src="{{ $person->avatar_url }}" alt="{{ $person->public_name }} avatar" class="h-14 w-14 rounded-full">
                    <div><p class="font-black">{{ $person->public_name }}</p><p class="text-sm text-zinc-400">{{ '@'.$person->username }}</p></div>
                </a>
            @empty
                <x-empty-state title="No users to show yet." />
            @endforelse
        </div>
        <div class="mt-8">{{ $people->links() }}</div>
    </section>
@endsection
