<?php

namespace Database\Seeders;

use App\Domain\Entity\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::query()->create([
            'name' => 'HR',
            'status' => 1,
        ]);
        Department::query()->create([
            'name' => 'Accounting',
            'status' => 1,
        ]);
        Department::query()->create([
            'name' => 'Call Center',
            'status' => 1,
        ]);
    }
}