<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Initial Permissions
     *
     * @var array
     */
    private $permissions = [
        [
            'name' => 'users-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'users-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'users-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'users-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'activities-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'permissions-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'permissions-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'permissions-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'permissions-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'roles-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'roles-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'roles-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'roles-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporders-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporders-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporders-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporders-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-phones-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-phones-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-phones-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'people-phones-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporder-items-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporder-items-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporder-items-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'shiporder-items-delete',
            'guard_name' => 'api',
        ],
        [
            'name' => 'xml-process-index',
            'guard_name' => 'api',
        ],
        [
            'name' => 'xml-process-store',
            'guard_name' => 'api',
        ],
        [
            'name' => 'xml-process-update',
            'guard_name' => 'api',
        ],
        [
            'name' => 'xml-process-delete',
            'guard_name' => 'api',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            $permission = Permission::firstOrCreate($permission);
            $role = Role::first();
            $role->givePermissionTo($permission);
        }
    }
}
