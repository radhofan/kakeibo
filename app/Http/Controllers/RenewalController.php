<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class RenewalController extends Controller
{
    public function __invoke(Request $request)
    {
        $renewals = Subscription::query()
            ->where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->whereDate('next_renewal_date', '<=', now()->addDays(14))
            ->orderBy('next_renewal_date')
            ->get();

        return view('renewals.index', compact('renewals'));
    }
}
