<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::create([
            'name' => 'User Customer',
            'email' => 'user@examples.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $customer->Customer()->create([
            'address' => null,
            'latitude' => null, 
            'longitude' => null,
        ]);
    }
}
