<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');
Route::patch('/products/{productId}/update', [TodoController::class, 'update'])->name('products.update');
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');




