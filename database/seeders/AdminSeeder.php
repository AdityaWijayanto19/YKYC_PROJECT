<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $adminUser = User::updateOrCreate(
                [
                    'email' => 'admin@ykyc.com',
                ],
                [
                    'name' => 'AdminYKYC',
                    'password' => Hash::make('password'), 
                    'role' => 'admin',
                    'email_verified_at' => now(), 
                ]
            );

            $adminUser->admin()->updateOrCreate(
                [
                    'user_id' => $adminUser->id,
                ],
                [
                    'action' => 'Akun dibuat melalui seeder.'
                ]
            );
        });
    }
}