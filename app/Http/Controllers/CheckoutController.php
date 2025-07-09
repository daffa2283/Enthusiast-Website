<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }
        
        $shipping = $subtotal > 500000 ? 0 : 15000;
        $total = $subtotal + $shipping;
        
        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }
    
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        
        // Validate form data
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet,cod',
            'notes' => 'nullable|string|max:500',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try {
            DB::beginTransaction();
            
            // Calculate totals
            $subtotal = 0;
            foreach ($cart as $details) {
                $subtotal += $details['price'] * $details['quantity'];
            }
            
            $shipping = $subtotal > 500000 ? 0 : 15000;
            $total = $subtotal + $shipping;
            
            // Create order
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null, // Link to user if logged in
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
            ]);
            
            // Create order items
            foreach ($cart as $cartKey => $details) {
                // Extract product ID from cart key (handles both old and new format)
                $productId = isset($details['product_id']) ? $details['product_id'] : explode('_', $cartKey)[0];
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $details['name'],
                    'product_price' => $details['price'],
                    'quantity' => $details['quantity'],
                    'total' => $details['price'] * $details['quantity'],
                    'size' => $details['size'] ?? null,
                    'color' => $details['color'] ?? null,
                ]);
                
                // Update product stock
                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $details['quantity']);
                }
            }
            
            DB::commit();
            
            // Clear cart
            session()->forget('cart');
            session()->forget('cart_count');
            
            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Order placed successfully!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }
    
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        return view('checkout.success', compact('order'));
    }
    
    public function trackOrder(Request $request)
    {
        $orderNumber = $request->input('order_number');
        
        if (!$orderNumber) {
            return view('checkout.track');
        }
        
        $order = Order::with('orderItems.product')
            ->where('order_number', $orderNumber)
            ->first();
        
        if (!$order) {
            return view('checkout.track')
                ->with('error', 'Order not found. Please check your order number.');
        }
        
        return view('checkout.track', compact('order'));
    }
    
    public function confirmPayment($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            
            // Check if order is still pending
            if ($order->payment_status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah dikonfirmasi sebelumnya.'
                ]);
            }
            
            // Update order status
            $order->update([
                'status' => 'processing',
                'payment_status' => 'paid'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi! Pesanan Anda sedang diproses.'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Payment confirmation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengkonfirmasi pembayaran: ' . $e->getMessage()
            ]);
        }
    }
}