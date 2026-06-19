<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $id = Str::lower(Str::random(8));

        return [
            'name' => 'Demo User '.$id,
            'display_name' => 'Demo User '.$id,
            'username' => 'demo-'.$id,
            'email' => 'demo-'.$id.'@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar_url' => 'https://api.dicebear.com/8.x/initials/svg?seed='.$id,
            'profile_visibility' => 'public',
            'library_visibility' => 'public',
            'activity_visibility' => 'public',
            'role' => 'member',
            'account_status' => 'active',
            'remember_token' => Str::random(10),
        ];
    }
}
