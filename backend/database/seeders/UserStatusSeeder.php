<?php

namespace Database\Seeders;

use App\Domain\Entity\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStatus::query()->create([
            'name' => 'Active',
        ]);
        UserStatus::query()->create([
            'name' => 'Inactive',
        ]);
    }
}