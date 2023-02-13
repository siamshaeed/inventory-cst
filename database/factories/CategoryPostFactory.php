<?php

namespace Database\Factories;

use App\Models\blog\Category;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class CategoryPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*$factory->define(App\CategoryPost::class, function (Faker $faker) {
            return [
                'category_id'   => factory(Category::class)->create()->id,
                'post_id'       => factory(Post::class)->create()->id,
            ];
        });*/

        /*DB::table('category_post')->insert(
            [
                'category_id'   => factory(Category::class)->create()->id,
                'post_id'       => factory(Post::class)->create()->id,
            ]
        );*/

    }
}
