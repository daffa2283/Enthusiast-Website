<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products for homepage (limit to 4)
        $products = Product::active()->inStock()->take(4)->get();
        
        return view('home', compact('products'));
    }
    
    public function products(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');
        
        $productsQuery = Product::active()->inStock();
        
        // Apply search filter
        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            });
        }
        
        // Apply category filter
        if ($category) {
            $productsQuery->where('category', $category);
        }
        
        $products = $productsQuery->get();
        $categories = Category::active()->get();
        
        return view('products', compact('products', 'categories', 'query', 'category'));
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function cart()
    {
        return view('cart');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = collect();
        
        if ($query) {
            $products = Product::active()
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                })
                ->get();
        }
        
        return view('search', compact('products', 'query'));
    }
    
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }
        
        $products = Product::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->take(5)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => asset($product->image),
                    'formatted_price' => $product->formatted_price,
                    'category' => $product->category,
                ];
            });
        
        return response()->json($products);
    }
    
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id', 1);
        $quantity = $request->input('quantity', 1);
        
        // Get product from database
        $product = Product::find($productId);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found!'
            ], 404);
        }
        
        // Get current cart from session
        $cart = session()->get('cart', []);
        
        // Handle quantity update (can be negative for decrease)
        if(isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            
            // If quantity becomes 0 or negative, remove item
            if ($newQuantity <= 0) {
                unset($cart[$productId]);
            } else {
                // Check if new quantity exceeds stock
                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more items. Stock limit reached!'
                    ], 400);
                }
                
                $cart[$productId]['quantity'] = $newQuantity;
            }
        } else {
            // Adding new item
            if ($quantity <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid quantity!'
                ], 400);
            }
            
            // Check stock for new item
            if ($product->stock < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock!'
                ], 400);
            }
            
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        // Calculate total cart count
        $cartCount = array_sum(array_column($cart, 'quantity'));
        session()->put('cart_count', $cartCount);
        
        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => 'Cart updated successfully!'
        ]);
    }
    
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('id');
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            
            // Update cart count
            $cartCount = array_sum(array_column($cart, 'quantity'));
            session()->put('cart_count', $cartCount);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart successfully!'
        ]);
    }
}