<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get only active products that are in stock for homepage
        $products = Product::active()->inStock()->orderBy('created_at', 'desc')->get();
        // Get active categories for homepage navigation
        $categories = Category::active()->get();
        return view('home', compact('products', 'categories'));
    }
    
    public function products(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');
        
        // Show all active products (including out of stock, but out of stock will be shown at bottom)
        $productsQuery = Product::where('is_active', true);
        
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
        
        // Order by stock status first (in stock first), then by newest
        $products = $productsQuery->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        // Get categories from existing products
        $categories = Product::where('is_active', true)
                            ->select('category')
                            ->distinct()
                            ->pluck('category');
        
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
                ->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
                ->orderBy('created_at', 'desc')
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
                  ->orWhere('category', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image ? asset('storage/' . $product->image) : asset('images/MOCKUP DEPAN.jpeg.jpg'),
                    'formatted_price' => $product->formatted_price,
                    'category' => ucfirst($product->category),
                    'stock' => $product->stock,
                    'url' => route('product.detail', $product->id)
                ];
            });
        
        return response()->json($products);
    }
    
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id', 1);
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size', '');
        $color = $request->input('color', '');
        
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
        
        // Create unique cart key based on product ID, size, and color
        $cartKey = $productId;
        if ($size || $color) {
            $cartKey = $productId . '_' . $size . '_' . $color;
        }
        
        // Handle quantity update (can be negative for decrease)
        if(isset($cart[$cartKey])) {
            $newQuantity = $cart[$cartKey]['quantity'] + $quantity;
            
            // If quantity becomes 0 or negative, remove item
            if ($newQuantity <= 0) {
                unset($cart[$cartKey]);
            } else {
                // Check if new quantity exceeds stock
                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more items. Stock limit reached!'
                    ], 400);
                }
                
                $cart[$cartKey]['quantity'] = $newQuantity;
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
            
            $cart[$cartKey] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'size' => $size,
                'color' => $color
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
        $cartKey = $request->input('id');
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
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

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        
        return response()->json([
            'count' => $cartCount
        ]);
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }
    
    public function quickView($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            // Return default product data for demo purposes
            $product = (object) [
                'id' => $id,
                'name' => $this->getDefaultProductName($id),
                'description' => $this->getDefaultProductDescription($id),
                'price' => $this->getDefaultProductPrice($id),
                'formatted_price' => $this->getDefaultProductFormattedPrice($id),
                'image' => $this->getDefaultProductImage($id),
                'back_image' => $this->getDefaultProductBackImage($id),
                'category' => 'Clothing',
                'stock' => 10,
                'size' => 'S, M, L, XL',
                'color' => 'Black, White, Gray'
            ];
        }
        
        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description ?? $this->getDefaultProductDescription($product->id),
                'price' => $product->price ?? $this->getDefaultProductPrice($product->id),
                'formatted_price' => $product->formatted_price ?? $this->getDefaultProductFormattedPrice($product->id),
                'image' => $product->image ? asset('storage/' . $product->image) : $this->getDefaultProductImage($product->id),
                'back_image' => $product->back_image ? asset('storage/' . $product->back_image) : $this->getDefaultProductBackImage($product->id),
                'category' => $product->category ?? 'Clothing',
                'stock' => $product->stock ?? 10,
                'size' => $product->size ?? 'S, M, L, XL',
                'color' => $product->color ?? 'Black, White, Gray'
            ]
        ]);
    }
    
    private function getDefaultProductName($id)
    {
        $names = [
            1 => 'Essential Crewneck',
            2 => 'Premium Hoodie',
            3 => 'Classic Tee',
            4 => 'Street Hoodie'
        ];
        
        return $names[$id] ?? 'Product ' . $id;
    }
    
    private function getDefaultProductDescription($id)
    {
        $descriptions = [
            1 => 'A comfortable and stylish crewneck perfect for everyday wear. Made from premium cotton blend for ultimate comfort.',
            2 => 'Premium quality hoodie with soft fleece lining. Perfect for casual outings and staying cozy.',
            3 => 'Classic t-shirt with modern fit. Essential piece for any wardrobe. Comfortable and versatile.',
            4 => 'Street-style hoodie with urban design. Perfect for expressing your unique style.'
        ];
        
        return $descriptions[$id] ?? 'High-quality product with excellent craftsmanship and attention to detail.';
    }
    
    private function getDefaultProductPrice($id)
    {
        $prices = [
            1 => 399000,
            2 => 599000,
            3 => 299000,
            4 => 699000
        ];
        
        return $prices[$id] ?? 399000;
    }
    
    private function getDefaultProductFormattedPrice($id)
    {
        $price = $this->getDefaultProductPrice($id);
        return 'Rp. ' . number_format($price, 0, ',', '.');
    }
    
    private function getDefaultProductImage($id)
    {
        $images = [
            1 => asset('images/MOCKUP DEPAN.jpeg.jpg'),
            2 => asset('images/MOCKUP DEPAN11.jpeg.jpg'),
            3 => asset('images/MOCKUP DEPAN.jpeg.jpg'),
            4 => asset('images/MOCKUP DEPAN11.jpeg.jpg')
        ];
        
        return $images[$id] ?? asset('images/MOCKUP DEPAN.jpeg.jpg');
    }
    
    private function getDefaultProductBackImage($id)
    {
        $backImages = [
            1 => asset('images/MOCKUP BELAKANG.jpeg.jpg'),
            2 => asset('images/MOCKUP BELAKANG.11jpeg.jpg'),
            3 => asset('images/MOCKUP BELAKANG.jpeg.jpg'),
            4 => asset('images/MOCKUP BELAKANG.11jpeg.jpg')
        ];
        
        return $backImages[$id] ?? asset('images/MOCKUP BELAKANG.jpeg.jpg');
    }
}