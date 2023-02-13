<?php

namespace Database\Seeders;

use App\Models\MarketType;
use Illuminate\Database\Seeder;

class MarketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketType::factory()->count(5)->create();
    }
}
