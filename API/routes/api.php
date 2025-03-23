<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List products
Route::get('products', [ProductController::class, 'index'])->middleware('throttle:90,1');

// Create Product
Route::post('products', [ProductController::class, 'store'])->middleware('throttle:90,1', 'sanitize');

// Update Product
Route::put('products/{id}', [ProductController::class, 'update'])->middleware('throttle:90,1', 'sanitize');

// Delete Producto
Route::delete('products/{id}', [ProductController::class, 'destroy'])->middleware('throttle:90,1');

// List Categories
Route::get('categories', [CategoryController::class, 'index'])->middleware('throttle:90,1');

// Create Categories
Route::post('categories', [CategoryController::class, 'store'])->middleware('throttle:90,1', 'sanitize');

// Update Categories
Route::put('categories/{id}', [CategoryController::class, 'update'])->middleware('throttle:90,1', 'sanitize');

// Delete Categories
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->middleware('throttle:90,1');
