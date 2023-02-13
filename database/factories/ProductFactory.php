<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'good_id'       => $this->faker->unique()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'category_id'   => $this->faker->numberBetween(1, 30),
            'brand_id'      => $this->faker->numberBetween(1, 20),
            'model'         => Str::random(4),
            'details'       => $this->faker->realTextBetween(20, 200),
            'stock'         => 0,
            'image'         => 'blank_product.jpg',
            'status'        => 1,
        ];
    }
}
