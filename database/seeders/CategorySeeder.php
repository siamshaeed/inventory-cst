<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name'      => 'Expense One',
            'status'    => 1,
            'type'      => 2,
            'slug'      => Str::slug('Expense One'),
        ]);
        DB::table('categories')->insert([
            'name'      => 'Expense Two',
            'status'    => 1,
            'type'      => 2,
            'slug'      => Str::slug('Expense Two'),
        ]);
        DB::table('categories')->insert([
            'name'      => 'Expense Three',
            'status'    => 1,
            'type'      => 2,
            'slug'      => Str::slug('Expense Three'),
        ]);

        Category::factory()->count(30)->create();
    }
}
