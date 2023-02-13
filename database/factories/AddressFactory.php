<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'division_id'   => $this->faker->numberBetween(1, 5),
            'district_id'   => $this->faker->numberBetween(1, 5),
            'upazila_id'    => $this->faker->numberBetween(1, 5),
            'union_id'      => $this->faker->numberBetween(1, 5),
            'name'          => 'Dhanmondi, Mirpur Road, Dhaka 1207',
            'bn_name'       => 'ধানমন্ডি, মিরপুর রোড, ঢাকা ১২০৭',
            'phone_1'       => '01777'.$this->faker->randomNumber(6),
            'phone_2'       => '01999'.$this->faker->randomNumber(6),
        ];
    }
}
