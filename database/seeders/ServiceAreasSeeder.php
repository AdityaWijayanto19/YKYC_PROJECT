<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceAreasSeeder extends Seeder
{
    public function run(): void
    {
        $geojson = '{
  "type": "FeatureCollection",
  "name": "Kecamatan_Lowokwaru",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "name": "Lowokwaru",
        "kota": "Malang",
        "provinsi": "Jawa Timur"
      },
      "geometry": {
        "type": "Polygon",
        "coordinates": [
          [
            [112.6035056, -7.9595366],
            [112.6039479, -7.9583896],
            [112.6051175, -7.9517517],
            [112.6100775, -7.9396795],
            [112.6185132, -7.9392859],
            [112.6265090, -7.9362426],
            [112.6357390, -7.9473717],
            [112.6409638, -7.9546729],
            [112.6407239, -7.9642990],
            [112.6396225, -7.9685710],
            [112.6243191, -7.9750663],
            [112.6139437, -7.9769779],
            [112.6036296, -7.9724824],
            [112.6024405, -7.9653519],
            [112.6035056, -7.9595366]
          ]
        ]
      }
    }
  ]
}
';


        DB::table('service_areas')->insert([
            'name' => 'Lowokwaru',
            'polygon_coordinates' => $geojson,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
