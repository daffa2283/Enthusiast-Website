<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

try {
    $sampleProducts = [
        [
            'name' => 'ESSENTIAL CREWNECK THEY ALL HATE US',
            'description' => 'Premium cotton crewneck with bold statement design. Perfect for everyday wear with attitude.',
            'price' => 349000,
            'stock' => 25,
            'category' => 'crewneck',
            'size' => 'S,M,L,XL',
            'color' => 'Black,White,Gray',
            'is_active' => 1,
            'image' => 'products/MOCKUP DEPAN.jpeg.jpg',
            'back_image' => 'products/MOCKUP BELAKANG.jpeg.jpg'
        ],
        [
            'name' => 'PREMIUM HOODIE ENTHUSIAST',
            'description' => 'Ultra-soft fleece hoodie with premium materials. 350 GSM cotton blend for maximum comfort.',
            'price' => 599000,
            'stock' => 18,
            'category' => 'hoodie',
            'size' => 'M,L,XL,XXL',
            'color' => 'Black,Navy,Maroon',
            'is_active' => 1,
            'image' => 'products/MOCKUP DEPAN11.jpeg.jpg',
            'back_image' => 'products/MOCKUP BELAKANG11.jpeg.jpg'
        ],
        [
            'name' => 'CLASSIC TEE LOVE IS WEAPON',
            'description' => 'Comfortable cotton t-shirt with iconic EnthusiastVerse design. Essential wardrobe piece.',
            'price' => 249000,
            'stock' => 42,
            'category' => 'tshirt',
            'size' => 'S,M,L,XL',
            'color' => 'Black,White,Red',
            'is_active' => 1,
            'image' => 'products/MOCKUP DEPAN.jpeg.jpg',
            'back_image' => 'products/MOCKUP BELAKANG.jpeg.jpg'
        ],
        [
            'name' => 'STREET JACKET ENTHUSIAST VERSE',
            'description' => 'Urban-style jacket with water-resistant coating. Perfect for street fashion enthusiasts.',
            'price' => 799000,
            'stock' => 12,
            'category' => 'jacket',
            'size' => 'M,L,XL',
            'color' => 'Black,Olive,Navy',
            'is_active' => 1,
            'image' => 'products/MOCKUP DEPAN11.jpeg.jpg',
            'back_image' => 'products/MOCKUP BELAKANG11.jpeg.jpg'
        ],
        [
            'name' => 'OVERSIZED HOODIE THEY ALL HATE US',
            'description' => 'Oversized fit hoodie with dropped shoulders. Made from premium 400 GSM cotton fleece.',
            'price' => 699000,
            'stock' => 8,
            'category' => 'hoodie',
            'size' => 'L,XL,XXL',
            'color' => 'Black,Cream,Brown',
            'is_active' => 1,
            'image' => 'products/MOCKUP DEPAN.jpeg.jpg',
            'back_image' => 'products/MOCKUP BELAKANG.jpeg.jpg'
        ]
    ];

    echo "=== ADDING SAMPLE PRODUCTS ===\n\n";
    
    foreach ($sampleProducts as $productData) {
        $product = Product::create($productData);
        echo "✅ Added: " . $product->name . " (ID: " . $product->id . ")\n";
        echo "   Price: " . $product->formatted_price . "\n";
        echo "   Stock: " . $product->stock . " pcs\n";
        echo "   Category: " . ucfirst($product->category) . "\n";
        echo "-----------------------------------\n";
    }
    
    $totalProducts = Product::count();
    echo "\n🎉 SUCCESS! Total products in database: " . $totalProducts . "\n";
    
} catch (Exception $e) {
    echo "❌ Error adding products: " . $e->getMessage() . "\n";
}