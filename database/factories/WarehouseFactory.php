<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $market_type_name = [
            'Banglamotor Warehouse', 'Sukrabad Warehouse', 'Dhanmondi-27 Warehouse', 'Mirpur Warehouse', 'Bonani Warehouse'
        ];

        $name = $this->faker->unique()->randomElement($market_type_name);
        $slug = Str::slug($name);

        return [
            'name'      => $name,
            'title'     => $this->faker->userName,
            'address'   => $this->faker->address,
            'status'    => $this->faker->numberBetween(0,1),
            'slug'      => $slug,
        ];
    }
}
