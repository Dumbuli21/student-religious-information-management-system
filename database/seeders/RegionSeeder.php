<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/RegionSeeder.php
public function run(): void
{
    $regions = [
        'Arusha', 'Dar-es-Salaam', 'Dodoma', 'Geita', 'Iringa',
        'Kagera', 'Katavi', 'Kigoma', 'Kilimanjaro', 'Lindi',
        'Manyara', 'Mara', 'Mbeya', 'Morogoro', 'Mtwara',
        'Mwanza', 'Njombe', 'Pemba North', 'Pemba South', 'Pwani',
        'Rukwa', 'Ruvuma', 'Shinyanga', 'Simiyu', 'Singida',
        'Songwe', 'Tabora', 'Tanga', 'Zanzibar North',
        'Zanzibar South', 'Zanzibar West',
    ];

    foreach ($regions as $region) {
        \App\Models\Region::create(['name' => $region]);
    }
}
}
