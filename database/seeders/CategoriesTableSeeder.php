<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();

        $categories = [
            [
                'id' => 1,
                'name' => 'Food',
                'slug' => 'food',
                'status' => 1,
                'created_at' => $category->freshTimestamp(),
                'updated_at' => $category->freshTimestamp()
            ],
            [
                'id' => 2,
                'name' => 'Beverages',
                'slug' => 'beverages',
                'status' => 1,
                'created_at' => $category->freshTimestamp(),
                'updated_at' => $category->freshTimestamp()
            ],
            [
                'id' => 3,
                'name' => 'Tobacco',
                'slug' => 'tobacco',
                'status' => 1,
                'created_at' => $category->freshTimestamp(),
                'updated_at' => $category->freshTimestamp()
            ]
        ];

        Category::insert($categories);
    }
}
