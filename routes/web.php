<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}/details', [ProductController::class, 'details'])->name('product.details');
Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
