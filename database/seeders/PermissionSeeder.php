<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'          => 'plan.view',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'plan.crate',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'plan.edit',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'plan.delete',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'plan.status',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-category.view',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-category.crate',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-category.edit',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-category.delete',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-category.status',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-list.view',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-list.crate',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-list.edit',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-list.delete',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'service-list.status',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'workshops.view',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'workshops.crate',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'workshops.edit',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'workshops.delete',
            'guard_name'    => 'web',
        ]);
        Permission::create([
            'name'          => 'workshops.status',
            'guard_name'    => 'web',
        ]);
    }
}
