<?php

use App\Http\Controllers\Dashboard\CountriesController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PasswordResetController;
use App\Http\Controllers\Dashboard\PhoneVerificationController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dashboard', 'middleware' => ['role:superadministrator|administrator|affiliate|vendor']], function () {

    // verification routes
    Route::get('phone/verify', [PhoneVerificationController::class, 'show'])->name('phoneverification.notice')->middleware('auth', 'checkstatus');
    Route::post('phone/verify', [PhoneVerificationController::class, 'verify'])->name('phoneverification.verify')->middleware('auth', 'checkstatus');
    Route::get('/resend-code', [PhoneVerificationController::class, 'resend'])->name('resend-code')->middleware('auth', 'checkstatus');

    // home view route - dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'checkverified', 'checkstatus');

    // admin users routes
    Route::resource('users', UsersController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('users/export/', [UsersController::class, 'export'])->name('users.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-users', [UsersController::class, 'trashed'])->name('users.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-users/{user}', [UsersController::class, 'restore'])->name('users.restore')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/activate-users/{user}', [UsersController::class, 'activate'])->name('users.activate')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/block-users/{user}', [UsersController::class, 'block'])->name('users.block')->middleware('auth', 'checkverified', 'checkstatus');


    // countries routes
    Route::resource('countries', CountriesController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-countries', [CountriesController::class, 'trashed'])->name('countries.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-countries/{country}', [CountriesController::class, 'restore'])->name('countries.restore')->middleware('auth', 'checkverified', 'checkstatus');
});


// reset password routes
Route::get('/send-conf', [PasswordResetController::class, 'sendConf'])->name('send.conf');
Route::get('/password-reset-request', [PasswordResetController::class, 'index'])->name('password.reset.request');
Route::post('/password-reset-verify', [PasswordResetController::class, 'verify'])->name('password.reset.verify');
Route::post('/password-reset-change', [PasswordResetController::class, 'change'])->name('password.reset.change');
Route::get('/password-reset-confirm-show', [PasswordResetController::class, 'show'])->name('password.reset.confirm.show');
Route::get('/password-reset-resend', [PasswordResetController::class, 'resend'])->name('resend.code.password');
Route::post('/password-reset-confirm-password', [PasswordResetController::class, 'confirm'])->name('password.reset.confirm.password');
