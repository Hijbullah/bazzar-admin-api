<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Livewire\Attributes\TermsIndex;
use App\Http\Livewire\Categories\CategoryEdit;
use App\Http\Livewire\Categories\CategoryIndex;
use App\Http\Livewire\Products\CreateProduct;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function() {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/categories/{category:slug}/edit', CategoryEdit::class)->name('categories.edit');
    
    Route::resource('/products', ProductController::class);


    Route::get('/products/create', CreateProduct::class)->name('products.create');

    Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
    Route::get('/attributes/{attribute}/terms', TermsIndex::class)->name('attributes.terms.index');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order:order_code}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order:order_code}/status/{status}', [OrderController::class, 'orderStatus'])->name('orders.status');
});

require __DIR__.'/auth.php';
