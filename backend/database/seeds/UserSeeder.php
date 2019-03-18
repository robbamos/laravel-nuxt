<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'name' => 'Test Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password'),
                'role_id' => 1000,
            ],
            [
                'name' => 'Test User',
                'email' => 'user@email.com',
                'password' => bcrypt('password'),
                'role_id' => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
