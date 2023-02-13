<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'address_id'    => 1,
            'name'          => 'Admin Md Nasim',
            'email'         => 'admin@gmail.com',
            'phone_number'  => '01777888757',
            'user_type'     => '1',
            'password'      => bcrypt('password'),
        ]);
    }
}
