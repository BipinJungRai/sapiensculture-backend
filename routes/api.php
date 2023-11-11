<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category', CategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('deliveryfee', DeliveryController::class);


// subscribe
Route::post('/subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');

// order
Route::post('/order', [OrderController::class, 'order'])->name('order');
Route::post('/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');


