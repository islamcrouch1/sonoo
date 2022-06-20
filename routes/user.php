
<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserNotificationsController;
use App\Http\Controllers\User\MessagesController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WithdrawalsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'middleware' => ['role:superadministrator|administrator|affiliate|vendor']], function () {

    // home view route - Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'checkverified', 'checkstatus');

    // user routes
    Route::get('edit', [ProfileController::class, 'edit'])->name('user.edit')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('update', [ProfileController::class, 'update'])->name('user.update')->middleware('auth', 'checkverified', 'checkstatus');

    // user notification routes
    Route::get('/notification/change', [UserNotificationsController::class, 'changeStatus'])->name('notifications.change')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/notifications', [UserNotificationsController::class, 'index'])->name('notifications.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/notifications/change/all', [UserNotificationsController::class, 'changeStatusAll'])->name('notifications.change.all')->middleware('auth', 'checkverified', 'checkstatus');

    // user mesaages
    Route::get('messages', [MessagesController::class, 'index'])->name('messages.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('messages/store', [MessagesController::class, 'store'])->name('messages.store')->middleware('auth', 'checkverified', 'checkstatus');

    // withdrawalw route
    Route::get('withdrawals', [WithdrawalsController::class, 'index'])->name('withdrawals.user.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('withdrawals/store', [WithdrawalsController::class, 'store'])->name('withdrawals.user.store')->middleware('auth', 'checkverified', 'checkstatus');

    // store information route
    Route::post('store/update', [ProfileController::class, 'updateStore'])->name('user.store.update')->middleware('auth', 'checkverified', 'checkstatus');
});
