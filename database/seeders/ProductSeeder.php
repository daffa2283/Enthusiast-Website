<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Essential Crewneck',
                'description' => 'A comfortable and stylish crewneck sweatshirt perfect for everyday wear. Made from premium cotton blend for ultimate comfort.',
                'price' => 399000,
                'image' => 'images/MOCKUP DEPAN.jpeg.jpg',
                'category' => 'sweatshirt',
                'stock' => 50,
                'size' => 'S,M,L,XL',
                'color' => 'Black',
                'is_active' => true,
            ],
            [
                'name' => 'Premium Hoodie',
                'description' => 'High-quality hoodie with modern design. Features a comfortable hood and front pocket. Perfect for casual outings.',
                'price' => 599000,
                'image' => 'images/MOCKUP DEPAN11.jpeg.jpg',
                'category' => 'hoodie',
                'stock' => 30,
                'size' => 'S,M,L,XL',
                'color' => 'Black',
                'is_active' => true,
            ],
            [
                'name' => 'Classic Tee',
                'description' => 'Simple yet elegant t-shirt with premium fabric. Comfortable fit for daily activities.',
                'price' => 299000,
                'image' => 'images/MOCKUP DEPAN.jpeg.jpg',
                'category' => 't-shirt',
                'stock' => 75,
                'size' => 'S,M,L,XL,XXL',
                'color' => 'Black',
                'is_active' => true,
            ],
            [
                'name' => 'Street Hoodie',
                'description' => 'Urban style hoodie with street-inspired design. Perfect for those who love street fashion.',
                'price' => 699000,
                'image' => 'images/MOCKUP DEPAN11.jpeg.jpg',
                'category' => 'hoodie',
                'stock' => 25,
                'size' => 'M,L,XL',
                'color' => 'Black',
                'is_active' => true,
            ],
            [
                'name' => 'Vintage Crewneck',
                'description' => 'Retro-inspired crewneck with vintage aesthetics. Made from soft cotton for maximum comfort.',
                'price' => 449000,
                'image' => 'images/MOCKUP DEPAN.jpeg.jpg',
                'category' => 'sweatshirt',
                'stock' => 40,
                'size' => 'S,M,L,XL',
                'color' => 'Black',
                'is_active' => true,
            ],
            [
                'name' => 'Oversized Hoodie',
                'description' => 'Trendy oversized hoodie for a relaxed and comfortable look. Perfect for layering.',
                'price' => 649000,
                'image' => 'images/MOCKUP DEPAN11.jpeg.jpg',
                'category' => 'hoodie',
                'stock' => 35,
                'size' => 'M,L,XL,XXL',
                'color' => 'Black',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}