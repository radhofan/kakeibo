<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        $plans = ['Cloud Notes', 'Code Studio', 'Design Lab', 'Study Vault'];
        $categories = ['Developer Tools', 'Hosting', 'Learning', 'Lifestyle'];
        $cycles = ['weekly', 'monthly', 'quarterly', 'yearly'];
        $seed = random_int(0, 3);

        return [
            'user_id' => User::factory(),
            'name' => $plans[$seed].' '.Str::upper(Str::random(4)),
            'category' => $categories[$seed],
            'price' => 9.99 + ($seed * 7),
            'billing_cycle' => $cycles[$seed],
            'next_renewal_date' => now()->addDays(7 + ($seed * 5))->toDateString(),
            'payment_method' => 'Debit card',
            'status' => 'active',
            'notes' => null,
        ];
    }
}
