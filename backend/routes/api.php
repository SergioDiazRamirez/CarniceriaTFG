<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('products', [ProductController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{product}', [FavoriteController::class, 'destroy']);
    Route::get('/orders', [OrderController::class, 'userOrders']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::get('/user/index', [UserController::class, 'index']);
    Route::put('/user/update', [UserController::class, 'update']);
    Route::put('/user/password', [UserController::class, 'changePassword']);
    Route::delete('/user', [UserController::class, 'deleteAccount']);
});