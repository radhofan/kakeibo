@csrf
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-slate-700">Name</label>
        <input name="name" value="{{ old('name', $subscription->name ?? '') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Category</label>
        <input name="category" value="{{ old('category', $subscription->category ?? '') }}" required placeholder="Developer Tools" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Price</label>
        <input name="price" type="number" step="0.01" min="0" value="{{ old('price', $subscription->price ?? '') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Billing cycle</label>
        <select name="billing_cycle" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            @foreach (['weekly', 'monthly', 'quarterly', 'yearly'] as $cycle)
                <option value="{{ $cycle }}" @selected(old('billing_cycle', $subscription->billing_cycle ?? 'monthly') === $cycle)>{{ ucfirst($cycle) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Next renewal date</label>
        <input name="next_renewal_date" type="date" value="{{ old('next_renewal_date', isset($subscription) ? $subscription->next_renewal_date->format('Y-m-d') : '') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Payment method</label>
        <input name="payment_method" value="{{ old('payment_method', $subscription->payment_method ?? '') }}" placeholder="Debit card" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Status</label>
        <select name="status" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            @foreach (['active', 'paused', 'cancelled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $subscription->status ?? 'active') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Notes</label>
        <textarea name="notes" rows="4" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ old('notes', $subscription->notes ?? '') }}</textarea>
    </div>
</div>

@if ($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        {{ $errors->first() }}
    </div>
@endif

<div class="flex justify-end gap-3">
    <a href="{{ route('subscriptions.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Cancel</a>
    <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">{{ $button }}</button>
</div>
