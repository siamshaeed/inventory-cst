<?php

namespace Database\Factories\Blog;

use App\Models\blog\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        $slug = Str::slug($name);
        return [
            'name'          => $name,
            'description'   => $this->faker->realTextBetween(20, 200),
            'slug'          => $slug,
            'status'        => $this->faker->numberBetween(0,1),
        ];
    }
}
