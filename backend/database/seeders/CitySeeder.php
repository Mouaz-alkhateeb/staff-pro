<?php

namespace Database\Seeders;

use App\Domain\Entity\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        City::query()->create([
            'name' => 'Damascus',
        ]);
        City::query()->create([
            'name' => 'Aleepo',
        ]);
        City::query()->create([
            'name' => 'Idlib',
        ]);
        City::query()->create([
            'name' => 'Hama',
        ]);
        City::query()->create([
            'name' => 'Homs',
        ]);
    }
}
