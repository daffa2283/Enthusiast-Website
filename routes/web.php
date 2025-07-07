<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Checkout & Cart functionality (protected)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');
});
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/track-order', [CheckoutController::class, 'trackOrder'])->name('checkout.track');

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
