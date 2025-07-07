<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's orders - search by user_id first, then by email as fallback
        $orders = Order::with('orderItems')
                      ->where(function($query) use ($user) {
                          $query->where('user_id', $user->id)
                                ->orWhere('customer_email', $user->email);
                      })
                      ->orderBy('created_at', 'desc')
                      ->take(5)
                      ->get();
        
        // Calculate stats
        $totalOrders = Order::where(function($query) use ($user) {
                          $query->where('user_id', $user->id)
                                ->orWhere('customer_email', $user->email);
                      })->count();
                      
        $totalSpent = Order::where(function($query) use ($user) {
                          $query->where('user_id', $user->id)
                                ->orWhere('customer_email', $user->email);
                      })->sum('total');
                      
        $pendingOrders = Order::where(function($query) use ($user) {
                          $query->where('user_id', $user->id)
                                ->orWhere('customer_email', $user->email);
                      })
                      ->where('status', 'pending')
                      ->count();
        
        // Get cart count from session
        $cartCount = session('cart_count', 0);
        
        return view('dashboard', compact('orders', 'totalOrders', 'totalSpent', 'pendingOrders', 'cartCount'));
    }
}