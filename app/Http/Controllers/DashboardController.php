<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $subscriptions = Subscription::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('next_renewal_date')
            ->get();

        $active = $subscriptions->where('status', 'active');
        $monthlyTotal = $active->sum(fn (Subscription $subscription) => $subscription->monthlyCost());
        $upcoming = $active->take(5)->values();

        return view('dashboard', [
            'subscriptions' => $subscriptions,
            'activeCount' => $active->count(),
            'monthlyTotal' => $monthlyTotal,
            'yearlyProjection' => $monthlyTotal * 12,
            'upcoming' => $upcoming,
        ]);
    }
}
