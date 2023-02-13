<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title  = $this->faker->realText(50);
        $slug   = Str::slug($title);
        return [
            'user_id'       => 1,
            'title'         => $title,
            'short_desc'    => $this->faker->realTextBetween(200,400),
            'long_desc'     => $this->faker->realTextBetween(400,1200),
            'slug'          => $slug,
            'hit_count'     => $this->faker->numberBetween(1,20),
            'view_count'    => $this->faker->numberBetween(1,20),
            'status'        => $this->faker->numberBetween(0,1),
        ];
    }
}
