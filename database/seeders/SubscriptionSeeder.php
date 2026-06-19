<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();

        if (! $user) {
            return;
        }

        $items = [
            ['name' => 'GitHub Pro', 'category' => 'Developer Tools', 'price' => 4.00, 'billing_cycle' => 'monthly'],
            ['name' => 'Portfolio Domain', 'category' => 'Domains', 'price' => 14.00, 'billing_cycle' => 'yearly'],
            ['name' => 'Cloud Database', 'category' => 'Hosting', 'price' => 9.00, 'billing_cycle' => 'monthly'],
            ['name' => 'Music Streaming', 'category' => 'Lifestyle', 'price' => 5.99, 'billing_cycle' => 'monthly'],
        ];

        foreach ($items as $index => $item) {
            Subscription::create([
                ...$item,
                'user_id' => $user->id,
                'next_renewal_date' => now()->addDays(3 + ($index * 5))->toDateString(),
                'payment_method' => 'Debit card',
                'status' => 'active',
                'notes' => 'Demo subscription',
            ]);
        }
    }
}
