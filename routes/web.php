<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;

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

// Checkout functionality
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/track-order', [CheckoutController::class, 'trackOrder'])->name('checkout.track');

// Cart functionality
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');
