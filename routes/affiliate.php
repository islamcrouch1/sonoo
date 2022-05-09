<?php

use App\Http\Controllers\Affiliate\AffiliateProductsController;
use App\Http\Controllers\Affiliate\CartController;
use App\Http\Controllers\Affiliate\FavoriteController;
use App\Http\Controllers\Affiliate\OrdersController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'affiliate', 'middleware' => ['role:affiliate']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'checkverified', 'checkstatus');

    // affiliate products routes
    Route::get('products', [AffiliateProductsController::class, 'index'])->name('affiliate.products.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('products/{product}', [AffiliateProductsController::class, 'showProduct'])->name('affiliate.products.product')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('products/category/{category}', [AffiliateProductsController::class, 'showCatProducts'])->name('affiliate.products.category')->middleware('auth', 'checkverified', 'checkstatus');

    // favorite routes
    Route::get('favorite', [FavoriteController::class, 'index'])->name('favorite')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('favorite/{product}', [FavoriteController::class, 'add'])->name('favorite.add')->middleware('auth', 'checkverified', 'checkstatus');

    // affiliate cart routes
    Route::get('cart', [CartController::class, 'index'])->name('cart')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('cart/destroy/{product}/{stock}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth', 'checkverified', 'checkstatus');

    // add new order affiliate
    Route::post('order/store', [OrdersController::class, 'store'])->name('affiliate.orders.store')->middleware('auth', 'checkverified', 'checkstatus');
});
