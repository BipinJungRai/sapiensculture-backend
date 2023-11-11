<?php

use App\Http\Controllers\Admin\BulkEmailController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::resource('category2', CategoryController::class);
Route::resource('product2', ProductController::class);

Route::resource('subscribe2', SubscribeController::class);

Route::get('/bulk-email', [BulkEmailController::class, 'bulkEmail'])->name('bulk.email');
Route::get('/create-bulk-email', [BulkEmailController::class, 'createBulkEmail'])->name('create.bulk.email');

Route::post('/send-bulk-email', [BulkEmailController::class, 'sendBulkEmail'])->name('send.bulk.email');

Route::resource('deliveryfee2', DeliveryController::class);

Route::resource('order2', OrderController::class);

Route::get('/paid-orders', [OrderController::class, 'paid'])->name('paid.orders');
Route::get('/pending-orders', [OrderController::class, 'pending'])->name('pending.orders');
Route::get('/cancelled-orders', [OrderController::class, 'cancelled'])->name('cancelled.orders');
Route::get('/delivered-orders', [OrderController::class, 'delivered'])->name('delivered.orders');
Route::get('/unpaid-orders', [OrderController::class, 'unpaid'])->name('unpaid.orders');
Route::get('/delete-all-unpaid', [OrderController::class, 'deleteAllUnpaid'])->name('delete.all.unpaid');

Route::post('/orderstatus-update/{id}', [OrderController::class, 'orderstatus'])->name('orderstatus.update');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
