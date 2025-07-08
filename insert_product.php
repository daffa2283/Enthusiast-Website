<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

try {
    $product = Product::create([
        'name' => 'HOODIE ENTHUSIAST THEY ALL HATE US',
        'description' => 'Using Materials Cotton Fleece 330 GSM',
        'price' => 399000,
        'stock' => 36,
        'category' => 'hoodie',
        'size' => 'M,L,XL',
        'color' => 'Black',
        'is_active' => 1,
        'image' => 'products/LefI2XEQ9k38UrXH1B12QpJLlLxDTF-metaTU9DS1VQIERFUEFOIEhPT0RJRSBWNC5qcGVnLmpwZw==-.jpg',
        'back_image' => 'products/sKNs67YFhtGS3wACHzwPFz5gbbHGy3-metaTU9DS1VQIEJFTEFLQU5HIEhPT0RJRSBWNC5qcGVnLmpwZw==-.jpg'
    ]);

    echo "✅ Product inserted successfully!\n";
    echo "Product ID: " . $product->id . "\n";
    echo "Product Name: " . $product->name . "\n";
    echo "Price: " . $product->formatted_price . "\n";
    
} catch (Exception $e) {
    echo "❌ Error inserting product: " . $e->getMessage() . "\n";
}