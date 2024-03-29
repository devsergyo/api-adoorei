<?php

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


Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('api.user');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', \App\Http\Controllers\Api\Product\IndexController::class);
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', \App\Http\Controllers\Api\Order\IndexController::class);
        Route::post('/', \App\Http\Controllers\Api\Order\SearchController::class);
        Route::post('/create', \App\Http\Controllers\Api\Order\CreateController::class);
        Route::put('/cancel', \App\Http\Controllers\Api\Order\CancelController::class);
        Route::put('/add-products', \App\Http\Controllers\Api\Order\AddProductOrderController::class);
        Route::put('/checkout', \App\Http\Controllers\Api\Order\CheckoutController::class);
    });
});
