<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/user');


Route::get('/setlocale', function () {
    setLocaleBySession();
    return redirect()->back();
})->name('setlocale');


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/affiliate.php';
require __DIR__ . '/vendor.php';
require __DIR__ . '/verification.php';
require __DIR__ . '/user.php';
