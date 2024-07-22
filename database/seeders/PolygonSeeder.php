<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Polygon;
class PolygonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Polygon::create([
            'name' => 'Polígono 1',
            'coordinates' => json_encode([
                ['lat' => -34.397, 'lng' => 150.644],
                ['lat' => -34.397, 'lng' => 150.744],
                ['lat' => -34.497, 'lng' => 150.744],
                ['lat' => -34.497, 'lng' => 150.644]
            ]),
        ]);

        Polygon::create([
            'name' => 'Polígono 2',
            'coordinates' => json_encode([
                ['lat' => -34.297, 'lng' => 150.544],
                ['lat' => -34.297, 'lng' => 150.644],
                ['lat' => -34.397, 'lng' => 150.644],
                ['lat' => -34.397, 'lng' => 150.544]
            ]),
        ]);
    }
}
