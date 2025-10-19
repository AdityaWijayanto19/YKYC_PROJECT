<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WorkerSeeder extends Seeder
{
    public function run(): void
    {
        $mangkalUser1 = User::create([
            'name' => 'Budi Mangkal (UB)',
            'email' => 'mangkal.ub@ykyc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $mangkalUser1->worker()->create([
            'worker_type' => 'Mangkal',
            'location_name' => 'Gerobak Depan Kampus UB',
            'is_active' => false,
            'current_latitude' => -7.9556, 
            'current_longitude' => 112.6214,
        ]);

        $mangkalUser2 = User::create([
            'name' => 'Joko Mangkal (UM)',
            'email' => 'mangkal.um@ykyc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $mangkalUser2->worker()->create([
            'worker_type' => 'Mangkal',
            'location_name' => 'Gerobak Depan Kampus UM',
            'is_active' => false,
            'current_latitude' => -7.9705, 
            'current_longitude' => 112.6306,
        ]);

        $kelilingUser = User::create([
            'name' => 'Siti Keliling',
            'email' => 'keliling.siti@ykyc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $kelilingUser->worker()->create([
            'worker_type' => 'Keliling',
            'location_name' => 'Area Malang Kota', 
            'is_active' => false,
            'current_latitude' => null,
            'current_longitude' => null,
        ]);
    }
}
