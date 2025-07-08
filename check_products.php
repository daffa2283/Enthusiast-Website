<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

try {
    $products = Product::all();
    
    echo "=== ALL PRODUCTS IN DATABASE ===\n";
    echo "Total products: " . $products->count() . "\n\n";
    
    foreach ($products as $product) {
        echo "ID: " . $product->id . "\n";
        echo "Name: " . $product->name . "\n";
        echo "Description: " . $product->description . "\n";
        echo "Price: " . $product->formatted_price . "\n";
        echo "Stock: " . $product->stock . "\n";
        echo "Category: " . $product->category . "\n";
        echo "Size: " . $product->size . "\n";
        echo "Color: " . $product->color . "\n";
        echo "Image: " . $product->image . "\n";
        echo "Back Image: " . $product->back_image . "\n";
        echo "Active: " . ($product->is_active ? 'Yes' : 'No') . "\n";
        echo "-----------------------------------\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}