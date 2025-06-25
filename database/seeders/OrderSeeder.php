<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        
        // Create sample orders
        for ($i = 1; $i <= 10; $i++) {
            $order = Order::create([
                'customer_name' => 'Customer ' . $i,
                'customer_email' => 'customer' . $i . '@example.com',
                'customer_phone' => '08123456789' . $i,
                'shipping_address' => 'Jl. Contoh No. ' . $i . ', Jakarta',
                'subtotal' => 0, // Will be calculated
                'shipping_cost' => 15000,
                'total' => 0, // Will be calculated
                'status' => collect(['pending', 'processing', 'shipped', 'delivered'])->random(),
                'payment_status' => collect(['pending', 'paid'])->random(),
                'payment_method' => collect(['bank_transfer', 'credit_card', 'e_wallet'])->random(),
                'notes' => 'Sample order ' . $i,
            ]);

            // Add random order items
            $numItems = rand(1, 3);
            $subtotal = 0;

            for ($j = 0; $j < $numItems; $j++) {
                $product = $products->random();
                $quantity = rand(1, 2);
                $total = $product->price * $quantity;
                $subtotal += $total;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $total,
                ]);
            }

            // Update order totals
            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->shipping_cost,
            ]);
        }
    }
}