<?php

namespace Database\Seeders;

use App\Models\Blog\Replay;
use Illuminate\Database\Seeder;

class ReplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Replay::factory()->count(100)->create();
    }
}
