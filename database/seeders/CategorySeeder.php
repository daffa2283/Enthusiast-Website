<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'T-Shirts',
                'slug' => 't-shirts',
                'description' => 'Comfortable and stylish t-shirts for everyday wear',
                'is_active' => true,
            ],
            [
                'name' => 'Hoodies',
                'slug' => 'hoodies',
                'description' => 'Warm and cozy hoodies perfect for casual outings',
                'is_active' => true,
            ],
            [
                'name' => 'Sweatshirts',
                'slug' => 'sweatshirts',
                'description' => 'Premium sweatshirts with modern designs',
                'is_active' => true,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Complete your look with our accessories collection',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}