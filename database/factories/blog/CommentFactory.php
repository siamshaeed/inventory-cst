<?php

namespace Database\Factories\Blog;

use App\Models\blog\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'   => $this->faker->randomNumber(1, 10),
            'user_id'   => $this->faker->randomNumber(1, 20),
            'text'      => $this->faker->realTextBetween(50, 200),
        ];
    }
}
