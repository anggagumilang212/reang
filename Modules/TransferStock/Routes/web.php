<?php

use Illuminate\Support\Facades\Route;
use Modules\TransferStock\Http\Controllers\TransferStockController;


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

Route::group([], function () {
    Route::resource('transferstock', TransferStockController::class)->names('transferstock');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/transfer', 'TransferStockController@index')->name('transfer.index');
    Route::get('/transfer/create', 'TransferStockController@create')->name('transfer.create');
    Route::post('/transfer', 'TransferStockController@store')->name('transfer.store');
    Route::get('/transfer/{transfer}', 'TransferStockController@show')->name('transfer.show');
    Route::get('/check-stock/{product}/{branch}', 'TransferStockController@checkStock');
});
