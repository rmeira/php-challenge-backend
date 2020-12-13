<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
