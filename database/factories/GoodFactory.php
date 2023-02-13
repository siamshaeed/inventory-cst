<?php

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GoodFactory extends Factory
{
    protected $model = Good::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = [
            'Pen', 'Laptop', 'Ball', 'Water Pot', 'Bread', 'Book', 'Dairy', 'Keyboard', 'Headphone',
            'Chock-let', 'Mouse', 'Oil', 'Rice', 'Egg', 'Apple', 'Orange', 'Banana', 'Coconut', 'Mango', 'Seed'
        ];

        $name = $this->faker->unique()->randomElement($products);
        $slug = Str::slug($name);

        return [
            'name'      => $name,
            'status'    => $this->faker->numberBetween(0,1),
            'slug'      => $slug,
        ];
    }
}
