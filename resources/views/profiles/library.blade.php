@extends('layouts.app')

@section('title', $profile->public_name.' Library')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">{{ $profile->public_name }} Library</h1>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($entries as $entry)
                <x-anime-card :anime="$entry->anime" />
            @endforeach
        </div>
        <div class="mt-8">{{ $entries->links() }}</div>
    </section>
@endsection
