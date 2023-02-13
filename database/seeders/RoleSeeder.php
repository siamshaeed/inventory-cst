<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        Role::create([
            'name'          => 'admin',
            'guard_name'    => 'web',
        ]);
        Role::create([
            'name'          => 'workshop',
            'guard_name'    => 'web',
        ]);
        Role::create([
            'name'          => 'customer',
            'guard_name'    => 'web',
        ]);
    }
}
