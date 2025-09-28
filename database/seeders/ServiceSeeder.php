<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service; // Jangan lupa tambahkan ini!

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create(['name' => 'Quick Clean', 'price' => 25000, 'description' => 'Pembersihan cepat bagian luar dan sol.']);
        Service::create(['name' => 'Deep Clean', 'price' => 45000, 'description' => 'Pembersihan total luar, dalam, dan tali sepatu.']);
        Service::create(['name' => 'Unyellowing', 'price' => 35000, 'description' => 'Mengembalikan warna putih pada sol yang menguning.']);
    }
}