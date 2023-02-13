<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'               => 1,
            'supplier_id'           => 1,
            'date'                  => '2022-07-20 14:06:38',
            'order_number'          => '5051',
            'grand_total'           => 280,
            'total_discount'        => 0,
            'total_amount'          => 280,
        ];
    }
}
