@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-600">Kakeibo</p>
            <h1 class="text-2xl font-bold text-gray-950">Subscription overview</h1>
            <p class="text-sm text-gray-500">Track recurring payments before they surprise you.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Monthly total</p>
                <p class="mt-2 text-3xl font-bold">${{ number_format($monthlyTotal, 2) }}</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Yearly projection</p>
                <p class="mt-2 text-3xl font-bold">${{ number_format($yearlyProjection, 2) }}</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <p class="text-sm text-gray-500">Active subscriptions</p>
                <p class="mt-2 text-3xl font-bold">{{ $activeCount }}</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <h2 class="font-semibold text-gray-900">Upcoming renewals</h2>
            <div class="mt-4 divide-y divide-gray-100">
                @forelse ($upcoming as $subscription)
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-medium text-gray-900">{{ $subscription->name }}</p>
                            <p class="text-sm text-gray-500">{{ $subscription->category }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">${{ number_format($subscription->price, 2) }}</p>
                            <p class="text-sm text-gray-500">{{ $subscription->next_renewal_date->format('M d') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="py-8 text-center text-sm text-gray-500">No upcoming renewals.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
