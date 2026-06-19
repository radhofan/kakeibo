@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6 p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-700">Recurring payments</p>
                <h1 class="mt-1 text-2xl font-bold">Subscriptions</h1>
                <p class="mt-1 text-sm text-slate-500">Track tools, domains, apps, and services before they renew.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('subscriptions.export') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Export CSV</a>
                <a href="{{ route('subscriptions.create') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Add subscription</a>
            </div>
        </div>

        <form class="grid gap-3 rounded-xl border border-slate-200 bg-white p-4 md:grid-cols-3">
            <input name="category" value="{{ request('category') }}" placeholder="Filter by category" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <option value="">All statuses</option>
                @foreach (['active', 'paused', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50">Apply filters</button>
        </form>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
            @if ($subscriptions->count() === 0)
                <div class="p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-700">$</div>
                    <h2 class="mt-4 text-lg font-semibold">No subscriptions yet</h2>
                    <p class="mt-1 text-sm text-slate-500">Add your first recurring payment to see monthly totals.</p>
                </div>
            @else
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Renews</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($subscriptions as $subscription)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium">{{ $subscription->name }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $subscription->category }}</td>
                                <td class="px-4 py-3">${{ number_format($subscription->price, 2) }} / {{ $subscription->billing_cycle }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $subscription->next_renewal_date->format('M d, Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $subscription->status === 'active' ? 'bg-emerald-50 text-emerald-700' : ($subscription->status === 'paused' ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        @foreach (['active', 'paused', 'cancelled'] as $status)
                                            @if ($subscription->status !== $status)
                                                <form method="POST" action="{{ route('subscriptions.status', $subscription) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                    <button class="text-xs text-slate-500 hover:text-indigo-700">{{ ucfirst($status) }}</button>
                                                </form>
                                            @endif
                                        @endforeach
                                        <a href="{{ route('subscriptions.edit', $subscription) }}" class="text-indigo-700 hover:underline">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{ $subscriptions->links() }}
    </div>
@endsection
