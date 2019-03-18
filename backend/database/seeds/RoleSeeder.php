<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $roles = [
            [
                'id' => 1000,
                'name' => 'admin',
                'display_name' => 'Admin',
            ],
            [
                'id' => 1,
                'name' => 'user',
                'display_name' => 'User',
            ],
        ];
        Role::create($roles);
    }
}
