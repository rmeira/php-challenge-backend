<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Users admin for sync
     *
     * @var array
     */
    private $users = [
        [
            'email' => 'admin@phpchallenge.com.br',
            'name' => 'Admin PHP Challenge',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->users as $user) {
            $user = User::firstOrCreate($user);
            $role = Role::first();
            $user->assignRole($role->name);
        }
    }
}
