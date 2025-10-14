<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Buat atau temukan user dengan role admin
            $adminUser = User::updateOrCreate(
                [
                    // Cari berdasarkan email ini
                    'email' => 'admin@ykyc.com',
                ],
                [
                    // Data yang akan dibuat atau diupdate
                    'name' => 'AdminYKYC',
                    'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
                    'role' => 'admin',
                    'email_verified_at' => now(), // Anggap email langsung terverifikasi
                ]
            );

            // Buat atau temukan data di tabel 'admins' yang berelasi dengan user
            // Ini memastikan relasi hasOne() Anda terisi
            $adminUser->admin()->updateOrCreate(
                [
                    'user_id' => $adminUser->id,
                ],
                [
                    // Anda bisa menambahkan data default lain di sini jika perlu
                    'action' => 'Akun dibuat melalui seeder.'
                ]
            );
        });
    }
}