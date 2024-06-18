<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;


// Public routes accessible to all users
Route::get('/products', [ProductController::class, 'index']);
//Route::get('/products', 'ProductController@index');
Route::get('/products/{product}', [ProductController::class, 'show'])->middleware('auth:sanctum');
Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');


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


Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');


Route::post('/users/{user_id}/shops', 'ShopController@store');




