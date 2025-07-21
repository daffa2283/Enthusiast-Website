<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products page
Route::get('/products', [HomeController::class, 'products'])->name('products');

// About page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Cart page
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

// Search functionality
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');

// Cart count (available to all users)
Route::get('/cart/count', [HomeController::class, 'getCartCount'])->name('cart.count');

// CSRF token refresh endpoint
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
})->name('csrf.token');

// Session isolation test endpoints
Route::get('/test-session-isolation', function () {
    return response()->json([
        'web_user' => Auth::guard('web')->check() ? Auth::guard('web')->user()->only(['id', 'name', 'email']) : null,
        'admin_user' => Auth::guard('admin')->check() ? Auth::guard('admin')->user()->only(['id', 'name', 'email']) : null,
        'session_id' => session()->getId(),
        'csrf_token' => csrf_token(),
        'timestamp' => now()
    ]);
})->name('test.session.isolation');

// Cart test page (for debugging)
Route::get('/cart/test', function () {
    return view('cart-test');
})->name('cart.test');

// Cart and Checkout functionality (protected)
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Checkout success and tracking
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/payment-confirmed/{order}', [CheckoutController::class, 'paymentConfirmed'])->name('checkout.payment-confirmed');
Route::get('/checkout/payment-rejected/{order}', [CheckoutController::class, 'paymentRejected'])->name('checkout.payment-rejected');
Route::post('/checkout/upload-payment-proof/{order}', [CheckoutController::class, 'uploadPaymentProof'])
    ->middleware('web')
    ->name('checkout.upload-payment-proof');
Route::get('/checkout/check-payment-status/{order}', [CheckoutController::class, 'checkPaymentStatus'])
    ->name('checkout.check-payment-status');
Route::get('/track-order', [CheckoutController::class, 'trackOrder'])->name('checkout.track');

// Redirect old admin URLs to new admin panel
Route::get('/admin-old', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect('/admin-panel');
    }
    return redirect()->route('login')->with('info', 'Please login with your admin credentials to access the admin area.');
});

// Admin login redirect
Route::get('/admin-panel/login', function () {
    return redirect()->route('login')->with('info', 'Please login with your admin credentials to access the admin area.');
})->name('admin.login');

// Admin test route (for debugging)
Route::get('/admin-panel/test', function () {
    if (!auth()->check()) {
        return 'Not authenticated';
    }
    
    if (!auth()->user()->isAdmin()) {
        return 'Not admin - Role: ' . auth()->user()->role;
    }
    
    return 'Admin access working! User: ' . auth()->user()->name . ' (Role: ' . auth()->user()->role . ')';
})->middleware(['auth']);

// Custom Admin routes (separate from Filament)
Route::prefix('admin-panel')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'orderShow'])->name('admin.orders.show');
    Route::post('/orders/{id}/confirm-payment', [AdminController::class, 'confirmPayment'])->name('admin.orders.confirm-payment');
    Route::post('/orders/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');
});

// Product detail page
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');

// Product quick view
Route::get('/product/quick-view/{id}', [HomeController::class, 'quickView'])->name('product.quick-view');

// Dashboard (protected route)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Profile routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';