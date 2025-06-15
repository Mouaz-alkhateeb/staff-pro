<?php

namespace Database\Seeders;

use App\Domain\Entity\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin', 'display_name' => Lang::get('roles.admin'), 'status' => 1, 'created_by' => 1]);
        $user = Role::create(['name' => 'User', 'display_name' => Lang::get('roles.user'), 'status' => 1, 'created_by' => 1]);

        //------------------------------------------------------------------------------------//
        // PERMISSIONS
        $all_permissions = [

            [
                'name' => 'city_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_access')
            ],
            [
                'name' => 'city_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_show')
            ],
            [
                'name' => 'city_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_create')
            ],
            [
                'name' => 'city_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_delete')
            ],
            [
                'name' => 'city_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_edit')
            ],
            [
                'name' => 'city_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_list')
            ],


            [
                'name' => 'department_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_access')
            ],
            [
                'name' => 'department_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_show')
            ],
            [
                'name' => 'department_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_create')
            ],
            [
                'name' => 'department_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_delete')
            ],
            [
                'name' => 'department_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_edit')
            ],
            [
                'name' => 'department_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_list')
            ],


            [
                'name' => 'media_access',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_access')
            ],
            [
                'name' => 'media_show',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_show')
            ],
            [
                'name' => 'media_create',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_create')
            ],
            [
                'name' => 'media_delete',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_delete')
            ],
            [
                'name' => 'media_edit',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_edit')
            ],
            [
                'name' => 'media_list',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_list')
            ],

            [
                'name' => 'nationality_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_access')
            ],
            [
                'name' => 'nationality_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_show')
            ],
            [
                'name' => 'nationality_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_create')
            ],
            [
                'name' => 'nationality_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_delete')
            ],
            [
                'name' => 'nationality_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_edit')
            ],
            [
                'name' => 'nationality_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_list')
            ],

            [
                'name' => 'permission_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_access')
            ],
            [
                'name' => 'permission_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_show')
            ],
            [
                'name' => 'permission_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_create')
            ],
            [
                'name' => 'permission_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_delete')
            ],
            [
                'name' => 'permission_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_edit')
            ],
            [
                'name' => 'permission_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_list')
            ],

            [
                'name' => 'role_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_access')
            ],
            [
                'name' => 'role_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_show')
            ],
            [
                'name' => 'role_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_create')
            ],
            [
                'name' => 'role_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_delete')
            ],
            [
                'name' => 'role_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_edit')
            ],
            [
                'name' => 'role_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_list')
            ],


            // ---------------------------------- //
            [
                'name' => 'role_has_permission_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_access')
            ],
            [
                'name' => 'role_has_permission_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_show')
            ],
            [
                'name' => 'role_has_permission_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_create')
            ],
            [
                'name' => 'role_has_permission_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_delete')
            ],
            [
                'name' => 'role_has_permission_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_edit')
            ],
            [
                'name' => 'role_has_permission_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_list')
            ],

            // ---------------------------------- //
            [
                'name' => 'room_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_access')
            ],
            [
                'name' => 'room_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_show')
            ],
            [
                'name' => 'room_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_create')
            ],
            [
                'name' => 'room_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_delete')
            ],
            [
                'name' => 'room_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_edit')
            ],
            [
                'name' => 'room_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_list')
            ],

            [
                'name' => 'user_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_access')
            ],
            [
                'name' => 'user_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_show')
            ],
            [
                'name' => 'user_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_create')
            ],
            [
                'name' => 'user_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_delete')
            ],
            [
                'name' => 'user_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_edit')
            ],
            [
                'name' => 'user_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_list')
            ],


            [
                'name' => 'user_status_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_access')
            ],
            [
                'name' => 'user_status_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_show')
            ],
            [
                'name' => 'user_status_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_create')
            ],
            [
                'name' => 'user_status_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_delete')
            ],
            [
                'name' => 'user_status_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_edit')
            ],
            [
                'name' => 'user_status_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_list')
            ],


        ];

        // CREATE PERMISSIONS
        foreach ($all_permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'permission_group_id' => $permission['permission_group_id'],
                'display_name' => $permission['display_name']
            ]);
        }
        //------------------------------------------------------------------------------------//

        //------------------------------------------------------------------------------------//
        // ADMIN PERMISSIONS
        $admin_permissions = [

            // ---------------------------------- //
            [
                'name' => 'city_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_access')
            ],
            [
                'name' => 'city_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_show')
            ],
            [
                'name' => 'city_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_create')
            ],
            [
                'name' => 'city_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_delete')
            ],
            [
                'name' => 'city_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_edit')
            ],
            [
                'name' => 'city_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.city_list')
            ],



            // ---------------------------------- //
            [
                'name' => 'department_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_access')
            ],
            [
                'name' => 'department_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_show')
            ],
            [
                'name' => 'department_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_create')
            ],
            [
                'name' => 'department_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_delete')
            ],
            [
                'name' => 'department_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_edit')
            ],
            [
                'name' => 'department_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.department_list')
            ],



            // ---------------------------------- //
            [
                'name' => 'media_access',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_access')
            ],
            [
                'name' => 'media_show',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_show')
            ],
            [
                'name' => 'media_create',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_create')
            ],
            [
                'name' => 'media_delete',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_delete')
            ],
            [
                'name' => 'media_edit',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_edit')
            ],
            [
                'name' => 'media_list',
                'permission_group_id' => 2,
                'display_name' => Lang::get('permissions.media_list')
            ],


            [
                'name' => 'nationality_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_access')
            ],
            [
                'name' => 'nationality_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_show')
            ],
            [
                'name' => 'nationality_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_create')
            ],
            [
                'name' => 'nationality_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_delete')
            ],
            [
                'name' => 'nationality_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_edit')
            ],
            [
                'name' => 'nationality_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.nationality_list')
            ],


            // ---------------------------------- //
            [
                'name' => 'permission_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_access')
            ],
            [
                'name' => 'permission_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_show')
            ],
            [
                'name' => 'permission_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_create')
            ],
            [
                'name' => 'permission_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_delete')
            ],
            [
                'name' => 'permission_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_edit')
            ],
            [
                'name' => 'permission_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.permission_list')
            ],

            [
                'name' => 'role_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_access')
            ],
            [
                'name' => 'role_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_show')
            ],
            [
                'name' => 'role_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_create')
            ],
            [
                'name' => 'role_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_delete')
            ],
            [
                'name' => 'role_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_edit')
            ],
            [
                'name' => 'role_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_list')
            ],


            [
                'name' => 'role_has_permission_access',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_access')
            ],
            [
                'name' => 'role_has_permission_show',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_show')
            ],
            [
                'name' => 'role_has_permission_create',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_create')
            ],
            [
                'name' => 'role_has_permission_delete',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_delete')
            ],
            [
                'name' => 'role_has_permission_edit',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_edit')
            ],
            [
                'name' => 'role_has_permission_list',
                'permission_group_id' => 3,
                'display_name' => Lang::get('permissions.role_has_permission_list')
            ],

            // ---------------------------------- //
            [
                'name' => 'room_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_access')
            ],
            [
                'name' => 'room_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_show')
            ],
            [
                'name' => 'room_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_create')
            ],
            [
                'name' => 'room_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_delete')
            ],
            [
                'name' => 'room_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_edit')
            ],
            [
                'name' => 'room_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.room_list')
            ],


            [
                'name' => 'user_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_access')
            ],
            [
                'name' => 'user_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_show')
            ],
            [
                'name' => 'user_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_create')
            ],
            [
                'name' => 'user_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_delete')
            ],
            [
                'name' => 'user_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_edit')
            ],
            [
                'name' => 'user_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_list')
            ],


            // ---------------------------------- //
            [
                'name' => 'user_status_access',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_access')
            ],
            [
                'name' => 'user_status_show',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_show')
            ],
            [
                'name' => 'user_status_create',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_create')
            ],
            [
                'name' => 'user_status_delete',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_delete')
            ],
            [
                'name' => 'user_status_edit',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_edit')
            ],
            [
                'name' => 'user_status_list',
                'permission_group_id' => 1,
                'display_name' => Lang::get('permissions.user_status_list')
            ]
        ];

        // ASSIGN ADMIN PERMISSIONS TO ADMIN ROLE
        foreach ($admin_permissions as $permission) {
            $admin->givePermissionTo($permission['name']);
        }

        // ASSIGN ADMIN ROLE TO ADMIN USER
        $admin = User::where('id', 1)->first();
        $admin->assignRole('Admin');

        //------------------------------------------------------------------------------------//
        $user_permissions = [

            [
                'name' => 'media_access',
                'display_name' => Lang::get('permissions.media_access')
            ],
            [
                'name' => 'media_show',
                'display_name' => Lang::get('permissions.media_show')
            ],
            [
                'name' => 'media_create',
                'display_name' => Lang::get('permissions.media_create')
            ],
            [
                'name' => 'media_delete',
                'display_name' => Lang::get('permissions.media_delete')
            ],
            [
                'name' => 'media_edit',
                'display_name' => Lang::get('permissions.media_edit')
            ],
            [
                'name' => 'media_list',
                'display_name' => Lang::get('permissions.media_list')
            ],


            // ---------------------------------- //
            [
                'name' => 'nationality_access',
                'display_name' => Lang::get('permissions.nationality_access')
            ],
            [
                'name' => 'nationality_show',
                'display_name' => Lang::get('permissions.nationality_show')
            ],
            [
                'name' => 'nationality_list',
                'display_name' => Lang::get('permissions.nationality_list')
            ],


            [
                'name' => 'room_access',
                'display_name' => Lang::get('permissions.room_access')
            ],
            [
                'name' => 'room_show',
                'display_name' => Lang::get('permissions.room_show')
            ],
            [
                'name' => 'room_list',
                'display_name' => Lang::get('permissions.room_list')
            ],

            [
                'name' => 'user_status_access',
                'display_name' => Lang::get('permissions.user_status_access')
            ],
            [
                'name' => 'user_status_show',
                'display_name' => Lang::get('permissions.user_status_show')
            ],
            [
                'name' => 'user_status_list',
                'display_name' => Lang::get('permissions.user_status_list')
            ],
        ];



        foreach ($user_permissions as $permission) {
            $user->givePermissionTo($permission['name']);
        }
        //------------------------------------------------------------------------------------//
    }
}
