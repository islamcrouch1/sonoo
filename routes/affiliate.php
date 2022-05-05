<?php

use App\Http\Controllers\Affiliate\AffiliateProductsController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'affiliate', 'middleware' => ['role:affiliate']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'checkverified', 'checkstatus');

    // affiliate products routes
    Route::get('products', [AffiliateProductsController::class, 'index'])->name('affiliate.products.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('products/{product}', [AffiliateProductsController::class, 'showProduct'])->name('affiliate.products.product')->middleware('auth', 'checkverified', 'checkstatus');
});
