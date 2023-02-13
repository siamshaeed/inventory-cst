<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'           => 1,
            'order_id'          => 1,
            'date'              => '2022-07-20 14:06:38',

            'grand_amount'      => 590,
            'total_discount'    => 40,
            'total_pre_due'     => 50,
            'total_amount'      => 600,

            'total_pay'         => 580,
            'total_due'         => 20,
            'payment_status'    => 1,
        ];
    }
}
