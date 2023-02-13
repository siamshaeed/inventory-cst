<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(Category::class, 20)->create()->each(function ($u) {
            $u->Category->associate(factory(Post::class)->make());
        });*/

        $faker = Faker::create();

        for($count=1; $count<=20; $count++){
            DB::table('category_post')->insert([
                'category_id'   => $faker->numberBetween(1,30),
                'post_id'       => $faker->numberBetween(1,20),
            ]);
        }

    }
}
