<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =================================================================
        // WORKER 1: Tipe Mangkal (Lokasi Tetap)
        // =================================================================
        $mangkalUser1 = User::create([
            'name' => 'Budi Mangkal (UB)',
            'email' => 'mangkal.ub@ykc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $mangkalUser1->worker()->create([
            'worker_type' => 'Mangkal',
            'location_name' => 'Gerobak Depan Kampus UB',
            'is_active' => false,
            'current_latitude' => -7.9556, // koordinat sekitar UB
            'current_longitude' => 112.6214,
        ]);

        // =================================================================
        // WORKER 2: Tipe Mangkal (Lokasi Tetap Lain)
        // =================================================================
        $mangkalUser2 = User::create([
            'name' => 'Joko Mangkal (UM)',
            'email' => 'mangkal.um@ykc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $mangkalUser2->worker()->create([
            'worker_type' => 'Mangkal',
            'location_name' => 'Gerobak Depan Kampus UM',
            'is_active' => false,
            'current_latitude' => -7.9705, // koordinat sekitar UM
            'current_longitude' => 112.6306,
        ]);

        // =================================================================
        // WORKER 3: Tipe Keliling (Lokasi Dinamis)
        // =================================================================
        $kelilingUser = User::create([
            'name' => 'Siti Keliling',
            'email' => 'keliling.siti@ykc.com',
            'password' => Hash::make('password'),
            'role' => 'worker',
            'email_verified_at' => now(),
        ]);

        $kelilingUser->worker()->create([
            'worker_type' => 'Keliling',
            'location_name' => 'Area Malang Kota', // Lokasi umum
            'is_active' => false,
            'current_latitude' => null,
            'current_longitude' => null,
        ]);
    }
}
