<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;
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
            'category_id'   => $this->faker->numberBetween(1,3),
            'user_id'       => 1,
            'date'          => '2022-08-'.$this->faker->randomDigitNotZero(2).' 14:06:38',
            'title'         => $this->faker->realTextBetween(10, 30),
            'amount'        => $this->faker->randomNumber(3),
        ];
    }
}
