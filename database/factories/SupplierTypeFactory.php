<?php

namespace Database\Factories;

use App\Models\SupplierType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierTypeFactory extends Factory
{
    protected $model = SupplierType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $supplier_type_name = [
            'Customer', 'Local Company', 'Big Company', 'Industry', 'Production House'
        ];

        $name = $this->faker->unique()->randomElement($supplier_type_name);
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
