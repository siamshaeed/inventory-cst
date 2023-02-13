<?php

namespace Database\Factories;

use App\Models\PurchaseDue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PurchaseDueFactory extends Factory
{
    protected $model = PurchaseDue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'purchase_id' => 1,
            'date' => '2022-07-10 14:06:38',
            'amount' => 480,
            'pay' => 280,
            'due' => 200,
            'status' => 1,
        ];
    }
}
