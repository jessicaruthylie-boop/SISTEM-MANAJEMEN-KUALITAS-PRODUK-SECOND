<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// 1. RUTE CUSTOMER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/cart', [OrderController::class, 'cart'])->name('orders.cart');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{id}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// 2. RUTE ADMINISTRATOR (FIXED)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Inventory
    Route::get('/inventory', [AdminController::class, 'inventoryIndex'])->name('inventory.index');
    Route::get('/inventory/create', [AdminController::class, 'inventoryCreate'])->name('inventory.create');
    Route::post('/inventory', [AdminController::class, 'inventoryStore'])->name('inventory.store');
    Route::get('/inventory/{id}/edit', [AdminController::class, 'inventoryEdit'])->name('inventory.edit');
    Route::put('/inventory/{id}', [AdminController::class, 'inventoryUpdate'])->name('inventory.update');
    Route::delete('/inventory/{id}', [AdminController::class, 'inventoryDestroy'])->name('inventory.destroy');

    // Transactions
    Route::get('/transactions', [AdminController::class, 'transactionIndex'])->name('transactions.index');
    Route::patch('/transactions/{id}/verify', [AdminController::class, 'verifyPayment'])->name('transactions.verify');
    Route::patch('/transactions/{id}/void', [AdminController::class, 'voidOrder'])->name('void');

    // Users (PERBAIKAN DI SINI)
    Route::get('/users', [AdminController::class, 'userIndex'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('users.destroy'); 
});

require __DIR__.'/auth.php';