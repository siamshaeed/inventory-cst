<?php

namespace Database\Seeders;

use App\Models\Blog\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(50)->create();
    }
}
