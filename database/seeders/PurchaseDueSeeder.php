<?php

namespace Database\Seeders;

use App\Models\PurchaseDue;
use Illuminate\Database\Seeder;

class PurchaseDueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseDue::factory()->count(1)->create();
    }
}
