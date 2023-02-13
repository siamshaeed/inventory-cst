<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Replay;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplayFactory extends Factory
{
    protected $model = Replay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id'    => $this->faker->randomNumber(1, 20),
            'post_id'       => $this->faker->randomNumber(1, 10),
            'user_id'       => $this->faker->randomNumber(1, 20),
            'text'          => $this->faker->realTextBetween(50, 200),
        ];
    }
}
