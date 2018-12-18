<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\User;
use Illuminate\Console\Command;

/**
 * Seed User and Role tables
 *
 * @category Command
 * @package  Vertical
 * @author   Rob Amos <r.amos21@outlook.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/robbamos/laravel-nuxt
 */
class Initialise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed User and Roles tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::truncate();
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

        $users = [
            [
                'name' => 'Test Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Test User',
                'email' => 'user@email.com',
                'password' => bcrypt('password'),
            ],
        ];

        Role::create($roles);
        User::create($users);

        $admin = User::first();
        $admin->assignRole('admin');

    }
}
