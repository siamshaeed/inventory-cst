<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($count=1; $count<=20; $count++){
            DB::table('post_tag')->insert([
                'tag_id'    => $faker->numberBetween(1,50),
                'post_id'   => $faker->numberBetween(1,20),
            ]);
        }

    }
}
