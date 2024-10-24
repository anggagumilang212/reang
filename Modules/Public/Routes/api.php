<?php

use Illuminate\Http\Request;
use Modules\Public\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/public', function (Request $request) {
    return $request->user();
});

// midtrans api main
Route::group(['prefix' => 'api'], function () {
    Route::post('/checkout/snaptoken', [CheckoutController::class, 'snaptoken'])->name('api.checkout.snaptoken');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('api.checkout.process');
    Route::post('/midtrans/callback', [CheckoutController::class, 'callback'])->name('api.midtrans.callback');
});



