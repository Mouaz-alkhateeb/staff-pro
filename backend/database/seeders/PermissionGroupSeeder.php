<?php

namespace Database\Seeders;

use App\Domain\Entity\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionGroup::query()->create([
            'name' => 'User',
            'display_name' => Lang::get('permission_groups.user'),
        ]);
        PermissionGroup::query()->create([
            'name' => 'Media',
            'display_name' => Lang::get('permission_groups.media'),
        ]);
        PermissionGroup::query()->create([
            'name' => 'Role_And_Permission',
            'display_name' => Lang::get('permission_groups.role_and_permission'),
        ]);
    }
}
