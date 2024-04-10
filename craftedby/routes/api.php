<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//
//})->middleware('auth:sanctum');

// Group routes that require sanctum authentication
Route::middleware(['auth:sanctum'])->group(function () {
    // Route to get user details, accessible only to authenticated users
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route to get all users, accessible only to authenticated users
    Route::get('/users', [UserController::class, 'index']);
});


// Public routes accessible to all users
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{product}', [ProductController::class, 'update']);

// Route to get products by category
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']);

// Route to search products by keyword
Route::get('products/search/{keyword}', [ProductController::class, 'search']);

//user login token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
