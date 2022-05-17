<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Vendor\OrdersController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'vendor', 'middleware' => ['role:vendor']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'checkverified', 'checkstatus');


    // vendor orders routes indexOrdersVendors
    Route::get('orders', [OrdersController::class, 'index'])->name('orders.vendor.index')->middleware('auth', 'checkverified', 'checkstatus');
});
