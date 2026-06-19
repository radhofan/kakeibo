<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::query()
            ->where('user_id', $request->user()->id)
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->orderBy('next_renewal_date')
            ->paginate(12);

        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;

        Subscription::create($data);

        return redirect()->route('subscriptions.index')
            ->with('status', 'Subscription added.');
    }

    public function edit(Subscription $subscription)
    {
        $this->authorizeOwner($subscription);

        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $this->authorizeOwner($subscription);
        $subscription->update($this->validated($request));

        return redirect()->route('subscriptions.index')
            ->with('status', 'Subscription updated.');
    }

    public function destroy(Subscription $subscription)
    {
        $this->authorizeOwner($subscription);
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('status', 'Subscription deleted.');
    }

    public function status(Request $request, Subscription $subscription)
    {
        $this->authorizeOwner($subscription);

        $data = $request->validate([
            'status' => ['required', Rule::in(['active', 'paused', 'cancelled'])],
        ]);

        $subscription->update($data);

        return back()->with('status', 'Subscription status updated.');
    }

    public function export(Request $request): StreamedResponse
    {
        $subscriptions = Subscription::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('next_renewal_date')
            ->get();

        return response()->streamDownload(function () use ($subscriptions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Category', 'Price', 'Billing Cycle', 'Next Renewal', 'Payment Method', 'Status']);

            foreach ($subscriptions as $subscription) {
                fputcsv($handle, [
                    $subscription->name,
                    $subscription->category,
                    $subscription->price,
                    $subscription->billing_cycle,
                    $subscription->next_renewal_date->toDateString(),
                    $subscription->payment_method,
                    $subscription->status,
                ]);
            }

            fclose($handle);
        }, 'kakeibo-subscriptions.csv');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', Rule::in(['weekly', 'monthly', 'quarterly', 'yearly'])],
            'next_renewal_date' => ['required', 'date'],
            'payment_method' => ['nullable', 'string', 'max:80'],
            'status' => ['required', Rule::in(['active', 'paused', 'cancelled'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    private function authorizeOwner(Subscription $subscription): void
    {
        abort_unless($subscription->user_id === auth()->id(), 403);
    }
}
