<?php

namespace Database\Factories\Blog;

use App\Models\blog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->jobTitle();
        $slug = Str::slug($name);
        return [
            'name'      => $name,
            'status'    => $this->faker->numberBetween(0,1),
            'type'      => $this->faker->numberBetween(1,2),
            'slug'      => $slug,
        ];
    }
}
