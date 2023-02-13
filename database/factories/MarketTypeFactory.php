<?php

namespace Database\Factories;

use App\Models\MarketType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MarketTypeFactory extends Factory
{
    protected $model = MarketType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $market_type_name = [
            'Customer', 'Local Company', 'Big Company', 'Industry', 'Production House'
        ];

        $name = $this->faker->unique()->randomElement($market_type_name);
        $slug = Str::slug($name);

        return [
            'name'      => $name,
            'title'     => $this->faker->userName,
            'status'    => $this->faker->numberBetween(0,1),
            'slug'      => $slug,
        ];
    }
}
