<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Expense\Http\Controllers\ExpenseController;
use Modules\Public\Http\Controllers\CheckoutController;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest');

Route::group(['middleware' => 'guest'], function () {
    Route::get('gate', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('gate', 'Auth\LoginController@login');
});

Auth::routes(['register' => false, 'login' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');
});

// routes/web.php
Route::get('language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.available_locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

// Route untuk membuat symlink production
Route::get('/storage-link', function () {
    $target = storage_path('app/public');  // Target folder yang akan disimbolkan
    $link = $_SERVER['DOCUMENT_ROOT'] . '/storage';  // Lokasi link di public_html

    // Cek apakah link sudah ada
    if (file_exists($link)) {
        return 'The "storage" directory already exists!';
    }

    symlink($target, $link);  // Buat symlink manual

    return 'Storage link has been created successfully!';
});


Route::get('/sales/print-report',[SaleController::class, 'printreport'])->name('sales.print.report');
Route::get('/expenses/print-report',[ExpenseController::class, 'printreport'])->name('expenses.print.report');
