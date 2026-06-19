@extends('layouts.app')

@section('title', $profile->public_name.' Activity')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">{{ $profile->public_name }} Activity</h1>
        <div class="space-y-3">
            @forelse ($activities as $activity)
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <p class="font-bold">{{ str_replace('_', ' ', $activity->activity_type) }}</p>
                    <p class="mt-1 text-sm text-zinc-400">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <x-empty-state title="No public activity yet." />
            @endforelse
        </div>
        <div class="mt-8">{{ $activities->links() }}</div>
    </section>
@endsection
