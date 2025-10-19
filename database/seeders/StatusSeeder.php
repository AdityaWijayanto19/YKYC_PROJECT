<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'pending', 'label' => 'Menunggu Pembayaran'],
            ['name' => 'waiting_keliling', 'label' => 'Menunggu Driver'],
            ['name' => 'on-the-way', 'label' => 'Penjemputan'],
            ['name' => 'diproses', 'label' => 'Diproses'],
            ['name' => 'ready for pick up', 'label' => 'Siap diambil'],
            ['name' => 'completed', 'label' => 'Selesai'],
            ['name' => 'cancelled', 'label' => 'Dibatalkan'],
            ['name' => 'waiting_mangkal', 'label' => 'Menunggu'],
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate(
                ['name' => $status['name']], 
                ['label' => $status['label']] 
            );
        }
    }
}
