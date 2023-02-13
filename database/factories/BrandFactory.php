<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

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
            'name'              => $name,
            'company'           => $this->faker->domainName,
            'company_address'   => $this->faker->address,
            'status'            => $this->faker->numberBetween(0,1),
            'slug'              => $slug,
        ];
    }
}
