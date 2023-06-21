<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'store');
    Route::post('/login', 'login');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/product', 'store')->middleware('auth:sanctum');
    Route::get('/product', 'index');
});


