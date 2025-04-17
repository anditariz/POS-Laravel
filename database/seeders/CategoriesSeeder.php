<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categories::insert([
            ['category_name' => 'Makanan',],
            ['category_name' => 'Minuman',],
            ['category_name' => 'Snack',],
        ]);
    }
}
