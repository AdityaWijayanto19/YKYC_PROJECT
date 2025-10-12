<?php

namespace Database\Seeders;

use App\Models\Status; // PENTING: Panggil model Status
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Jalankan proses seeding database.
     */
    public function run(): void
    {
        // Kode ini akan membuat baris baru di tabel 'statuses'
        // untuk setiap status yang kita butuhkan.
        Status::create(['name' => 'pending', 'label' => 'Menunggu Pembayaran']);
        Status::create(['name' => 'waiting', 'label' => 'Menunggu Driver']);
        Status::create(['name' => 'on-the-way', 'label' => 'Penjemputan']);
        Status::create(['name' => 'diproses', 'label' => 'Diproses']);
        Status::create(['name' => 'ready for pick up', 'label' => 'Siap diambil']);
        Status::create(['name' => 'completed', 'label' => 'Selesai']);
        Status::create(['name' => 'cancelled', 'label' => 'Dibatalkan']);
    }
}