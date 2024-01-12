<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Models\Order;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);


// display shoes
Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes');
Route::get('/shoes/detail/{id}', [ShoeController::class, 'detail'])->name('shoes.detail');

// shoe add
Route::get('shoes/add', [ShoeController::class, 'add']);
Route::post('shoes/add', [ShoeController::class, 'create'])->name('shoe.create');

// brand add
Route::get('brands/add', [BrandController::class, 'add']);
Route::post('brands/add', [BrandController::class, 'create'])->name('brand.create');


// models add
Route::get('models/add', [ModelController::class, 'add']);
Route::post('models/add', [ModelController::class, 'create'])->name('model.create');

// contact
Route::get('/contact', [ContactController::class, 'add']);
Route::post('/contact', [ContactController::class, 'create'])->name('contacts.create');

// Dashboard
Route::get('shoes/dashboard', [ShoeController::class, 'dashboard'])->name('shoes.shoe_dashboard');
Route::get('shoes/brand/dashboard', [BrandController::class, 'dashboard'])->name('brands.brand_dashboard');
Route::get('shoes/models/dashboard', [ModelController::class, 'dashboard'])->name('shoe_models.model_dashboard');

// Shoe update/del/search
Route::get('/shoes/edit/{id}', [ShoeController::class, 'edit'])->name('edit');
Route::put('/shoes/update/{id}', [ShoeController::class, 'update'])->name('shoes.update');
Route::get('shoes/search', [ShoeController::class, 'search'])->name('shoes.search');


// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Manage dashboard
Route::get('/shoes/delete/{id}', [ShoeController::class, 'delete']);
Route::get('/shoes/brand/delete/{id}', [BrandController::class, 'delete']);
Route::get('/shoes/model/delete/{id}', [ModelController::class, 'delete']);


Auth::routes();
