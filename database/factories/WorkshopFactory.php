<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class WorkshopFactory extends Factory
{
    protected $model = Workshop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'           => User::factory(),
            'name'              => $this->faker->name(),
            'type'              => $this->faker->numberBetween(1, 3),
            'description'       => $this->faker->realText(200),
            'latitude'          => '23.'.$this->faker->randomNumber(),
            'longitude'         => '90.'.$this->faker->randomNumber(),
            'license_number'    => $this->faker->randomNumber(4),
        ];
    }
}
