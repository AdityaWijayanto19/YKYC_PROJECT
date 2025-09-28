<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Contoh koordinat nyata (Anda bisa sesuaikan)
        Location::create([
            'name' => 'Gerobak Senayan Park',
            'address' => 'Jl. Gerbang Pemuda No.3, Jakarta Pusat',
            'latitude' => -6.212030,
            'longitude' => 106.802030
        ]);

        Location::create([
            'name' => 'Gerobak Blok M Square',
            'address' => 'Jl. Melawai 5, Jakarta Selatan',
            'latitude' => -6.244900,
            'longitude' => 106.799700
        ]);

        Location::create([
            'name' => 'Gerobak Stasiun Gambir',
            'address' => 'Pintu Selatan Stasiun Gambir, Jakarta Pusat',
            'latitude' => -6.176600,
            'longitude' => 106.830600
        ]);
    }
}
