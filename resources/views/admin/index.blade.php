@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Admin</h1>
        @include('admin.partials.nav')
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-6">
            @foreach (['Users' => $users, 'Active Users' => $activeUsers, 'Reviews' => $reviews, 'Comments' => $comments, 'Open Reports' => $reports, 'Cached Anime' => $anime] as $label => $value)
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4"><p class="text-sm text-zinc-400">{{ $label }}</p><p class="mt-2 text-3xl font-black">{{ $value }}</p></div>
            @endforeach
        </div>
        <h2 class="mb-4 mt-10 text-2xl font-black">Reports Queue</h2>
        <div class="space-y-3">
            @forelse ($recentReports as $report)
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">{{ $report->reason }} · {{ $report->status }}</div>
            @empty
                <x-empty-state title="No reports are open." />
            @endforelse
        </div>
    </section>
@endsection
