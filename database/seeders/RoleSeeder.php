<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Default admin permission
     */
    private $roles = [
        [
            'name' => 'Administrators',
            'guard_name' => 'api'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
