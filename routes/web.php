<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaundryController;

// Halaman Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman About Us
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Halaman Services
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Halaman Pricing
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Orders Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('admin.tambahOrder');
    Route::post('/orders', [OrderController::class, 'store'])->name('admin.storeOrder');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.viewOrder');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.editOrder');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('admin.updateOrder');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('admin.deleteOrder');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

    // Laundry Routes
    Route::get('/laundries', [LaundryController::class, 'index'])->name('admin.laundryIndex');
    Route::get('/laundries/create', [LaundryController::class, 'create'])->name('admin.laundryCreate');
    Route::post('/laundries', [LaundryController::class, 'store'])->name('admin.laundryStore');
    Route::get('/laundries/{laundry}/edit', [LaundryController::class, 'edit'])->name('admin.laundryEdit');
    Route::put('/laundries/{laundry}', [LaundryController::class, 'update'])->name('admin.laundryUpdate');
    Route::delete('/laundries/{laundry}', [LaundryController::class, 'destroy'])->name('admin.laundryDelete');
});

// Include auth.php routes
require __DIR__.'/auth.php';
