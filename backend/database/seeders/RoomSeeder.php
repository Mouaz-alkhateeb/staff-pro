<?php

namespace Database\Seeders;

use App\Domain\Entity\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::query()->create([
            'number' => 1,
            'floor' => 1,
            'department_id' => 1,
            'status' => 1,

        ]);
        Room::query()->create([
            'number' => 2,
            'floor' => 1,
            'department_id' => 1,
            'status' => 1,
        ]);
        Room::query()->create([
            'number' => 3,
            'floor' => 2,
            'department_id' => 2,
            'status' => 1,
        ]);
        Room::query()->create([
            'number' => 2,
            'floor' => 1,
            'department_id' => 3,
            'status' => 1,
        ]);
        Room::query()->create([
            'number' => 2,
            'floor' => 2,
            'department_id' => 3,
            'status' => 1,
        ]);
    }
}