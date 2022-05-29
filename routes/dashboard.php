<?php

use App\Http\Controllers\Dashboard\BonusController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ColorsController;
use App\Http\Controllers\Dashboard\CountriesController;
use App\Http\Controllers\Dashboard\ExportController;
use App\Http\Controllers\Dashboard\FinancesController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LogsController;
use App\Http\Controllers\Dashboard\MessagesController;
use App\Http\Controllers\Dashboard\NotesController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\PasswordResetController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\ShippingRatesController;
use App\Http\Controllers\Dashboard\SizesController;
use App\Http\Controllers\Dashboard\SlidesController;
use App\Http\Controllers\Dashboard\StockController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\WithdrawalsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dashboard', 'middleware' => ['role:superadministrator|administrator']], function () {

    // admin users routes
    Route::resource('users', UsersController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('users/export/', [UsersController::class, 'export'])->name('users.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-users', [UsersController::class, 'trashed'])->name('users.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-users/{user}', [UsersController::class, 'restore'])->name('users.restore')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/activate-users/{user}', [UsersController::class, 'activate'])->name('users.activate')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/block-users/{user}', [UsersController::class, 'block'])->name('users.block')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('/add-bonus/{user}', [UsersController::class, 'bonus'])->name('users.bonus')->middleware('auth', 'checkverified', 'checkstatus');

    // countries routes
    Route::resource('countries', CountriesController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-countries', [CountriesController::class, 'trashed'])->name('countries.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-countries/{country}', [CountriesController::class, 'restore'])->name('countries.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // withdrawal routes
    Route::get('withdrawals', [WithdrawalsController::class, 'index'])->name('withdrawals.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('withdrawals/update/{withdrawal}', [WithdrawalsController::class, 'update'])->name('withdrawals.update')->middleware('auth', 'checkverified', 'checkstatus');

    // roles routes
    Route::resource('roles',  RoleController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-roles', [RoleController::class, 'trashed'])->name('roles.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-roles/{role}', [RoleController::class, 'restore'])->name('roles.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // categories routes
    Route::resource('categories', CategoriesController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-categories', [CategoriesController::class, 'trashed'])->name('categories.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-categories/{category}', [CategoriesController::class, 'restore'])->name('categories.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // settings route
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store')->middleware('auth', 'checkverified', 'checkstatus');

    // products routes
    Route::resource('products', ProductsController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-products', [ProductsController::class, 'trashed'])->name('products.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-products/{product}', [ProductsController::class, 'restore'])->name('products.restore')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/products/stock/{product}', [ProductsController::class, 'stockCreate'])->name('products.stock.create')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('/products/stock-store/{product}', [ProductsController::class, 'stockStore'])->name('products.stock.store')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/products/color/{product}', [ProductsController::class, 'colorCreate'])->name('products.color.create')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('/products/color-store/{product}', [ProductsController::class, 'colorStore'])->name('products.color.store')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/stock/color-remove/{stock}', [ProductsController::class, 'colorDestroy'])->name('products.color.destroy')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('products/status/{product}', [ProductsController::class, 'updateStatus'])->name('products.status')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('products-bulk/status', [ProductsController::class, 'updateStatusBulk'])->name('products.status.bulk')->middleware('auth', 'checkverified', 'checkstatus');

    // product color routes
    Route::resource('colors', ColorsController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-colors', [ColorsController::class, 'trashed'])->name('colors.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-colors/{color}', [ColorsController::class, 'restore'])->name('colors.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // product size routes
    Route::resource('sizes', SizesController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-sizes', [SizesController::class, 'trashed'])->name('sizes.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-sizes/{size}', [SizesController::class, 'restore'])->name('sizes.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // shipping rates routes
    Route::resource('shipping_rates', ShippingRatesController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-shipping_rates', [ShippingRatesController::class, 'trashed'])->name('shipping_rates.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-shipping_rates/{shipping_rate}', [ShippingRatesController::class, 'restore'])->name('shipping_rates.restore')->middleware('auth', 'checkverified', 'checkstatus');

    // slider routes
    Route::resource('slides', SlidesController::class)->middleware('auth', 'verifiedphone', 'checkstatus');
    Route::get('/trashed-slides', [SlidesController::class, 'trashed'])->name('slides.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-slides/{slide}', [SlidesController::class, 'restore'])->name('slides.restore')->middleware('auth', 'checkverified', 'checkstatus');


    // orders routes
    Route::resource('orders', OrdersController::class)->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('orders/status/{order}', [OrdersController::class, 'updateStatus'])->name('orders.status')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('orders-bulk/status', [OrdersController::class, 'updateStatusBulk'])->name('orders.status.bulk')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('orders/admin/refund/{order}', [OrdersController::class, 'rejectRefund'])->name('orders.refund.reject')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('orders/admin/refunds', [OrdersController::class, 'refundsIndex'])->name('orders.refunds')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('orders/admin/mandatory', [OrdersController::class, 'mandatoryIndex'])->name('orders.mandatory')->middleware('auth', 'checkverified', 'checkstatus');

    // vendors orders routes  orders.vendor.mandatory
    Route::get('vendor-orders', [OrdersController::class, 'indexVendors'])->name('orders-vendor')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('vendor-orders/status/{vendor_order}', [OrdersController::class, 'updateStatusVendor'])->name('orders.vendor.status')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('vendor-orders-bulk/status', [OrdersController::class, 'updateStatusVendorBulk'])->name('orders.vendor.status.bulk')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('vendor-orders/mandatory', [OrdersController::class, 'mandatoryIndexVendor'])->name('orders.vendor.mandatory')->middleware('auth', 'checkverified', 'checkstatus');

    // users and orders notes routes
    Route::post('user/note/{user}', [NotesController::class, 'addUserNote'])->name('users.note')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('order/note/{order}', [NotesController::class, 'addorderNote'])->name('orders.note')->middleware('auth', 'checkverified', 'checkstatus');

    // bonus routes
    Route::resource('bonus', BonusController::class)->middleware('auth', 'checkverified', 'checkstatus');

    // logs routes
    Route::resource('logs', LogsController::class)->middleware('auth', 'checkverified', 'checkstatus');

    // finances routes
    Route::get('finances', [FinancesController::class, 'index'])->name('finances.index')->middleware('auth', 'checkverified', 'checkstatus');

    // messages routes
    Route::get('messages/admin', [MessagesController::class, 'index'])->name('messages.admin.index')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('messages/admin/store/{user}', [MessagesController::class, 'store'])->name('messages.admin.store')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-messages', [MessagesController::class, 'trashed'])->name('messages.admin.trashed')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('/trashed-messages/{message}', [MessagesController::class, 'restore'])->name('messages.admin.restore')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('messages/delete/{message}', [MessagesController::class, 'destroy'])->name('messages.admin.destroy')->middleware('auth', 'checkverified', 'checkstatus');

    // export and import routes
    Route::get('orders/admin/export',  [ExportController::class, 'ordersExport'])->name('orders.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('withdrawals/admin/export', [ExportController::class, 'withdrawalsExport'])->name('withdrawals.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('products/admin/export', [ExportController::class, 'productsExport'])->name('products.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::get('users/admin/export', [ExportController::class, 'usersExport'])->name('users.export')->middleware('auth', 'checkverified', 'checkstatus');
    Route::post('products/import/', [ExportController::class, 'import'])->name('products.import')->middleware('auth', 'checkverified', 'checkstatus');

    // stock management routes
    Route::get('stock/management', [StockController::class, 'index'])->name('stock.management.index')->middleware('auth', 'checkverified', 'checkstatus');




    // --------------------------------------------- Vendors Routes ---------------------------------------------

    // vendor product routes
    Route::resource('vendor-products', ProductsController::class)->middleware('auth', 'checkverified', 'checkstatus');
});


// reset password routes
Route::get('/send-conf', [PasswordResetController::class, 'sendConf'])->name('send.conf');
Route::get('/password-reset-request', [PasswordResetController::class, 'index'])->name('password.reset.request');
Route::post('/password-reset-verify', [PasswordResetController::class, 'verify'])->name('password.reset.verify');
Route::post('/password-reset-change', [PasswordResetController::class, 'change'])->name('password.reset.change');
Route::get('/password-reset-confirm-show', [PasswordResetController::class, 'show'])->name('password.reset.confirm.show');
Route::get('/password-reset-resend', [PasswordResetController::class, 'resend'])->name('resend.code.password');
Route::post('/password-reset-confirm-password', [PasswordResetController::class, 'confirm'])->name('password.reset.confirm.password');
