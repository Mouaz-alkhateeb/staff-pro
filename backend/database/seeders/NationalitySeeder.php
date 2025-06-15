<?php

namespace Database\Seeders;

use App\Domain\Entity\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nationality::query()->create([
            'name' => 'Iraqi',
        ]);
        Nationality::query()->create([
            'name' => 'Syrian',
        ]);
        Nationality::query()->create([
            'name' => 'Lebanese',
        ]);
    }
}