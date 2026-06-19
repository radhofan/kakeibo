@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-700">Reminder simulation</p>
            <h1 class="mt-1 text-2xl font-bold">Upcoming renewals</h1>
            <p class="mt-1 text-sm text-slate-500">Subscriptions renewing in the next 14 days.</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            @forelse ($renewals as $renewal)
                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 last:border-b-0">
                    <div>
                        <p class="font-medium">{{ $renewal->name }}</p>
                        <p class="text-sm text-slate-500">{{ $renewal->category }} via {{ $renewal->payment_method ?: 'unspecified payment method' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">${{ number_format($renewal->price, 2) }}</p>
                        <p class="text-sm text-slate-500">{{ $renewal->next_renewal_date->format('M d') }}</p>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <h2 class="text-lg font-semibold">No renewals soon</h2>
                    <p class="mt-1 text-sm text-slate-500">You are clear for the next two weeks.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
