<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        $slug = Str::slug($name);
        return [
            'market_type_id'    => $this->faker->numberBetween(1,5),
            'name'              => $name,
            'address'           => $this->faker->address,
            'status'            => $this->faker->numberBetween(0,1),
            'slug'              => $slug,
        ];
    }
}
