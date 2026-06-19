@extends('layouts.app')

@section('title', 'Admin Reports')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <h1 class="text-4xl font-black">Reports Queue</h1>
        @include('admin.partials.nav')
        <div class="space-y-3">
            @foreach ($reports as $report)
                <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="grid gap-3 rounded-lg border border-white/10 bg-white/[0.04] p-4 md:grid-cols-[1fr_180px_1fr_auto] md:items-center">
                    @csrf @method('PATCH')
                    <div><p class="font-black">{{ $report->reason }}</p><p class="text-sm text-zinc-400">{{ class_basename($report->reportable_type) }} #{{ $report->reportable_id }}</p></div>
                    <select name="status" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">@foreach(['open','investigating','resolved','dismissed'] as $status)<option value="{{ $status }}" @selected($report->status === $status)>{{ $status }}</option>@endforeach</select>
                    <input name="resolution_note" value="{{ $report->resolution_note }}" placeholder="Resolution note" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                    <button class="rounded-md bg-rose-600 px-4 py-2 text-sm font-black">Save</button>
                </form>
            @endforeach
        </div>
        <div class="mt-8">{{ $reports->links() }}</div>
    </section>
@endsection
