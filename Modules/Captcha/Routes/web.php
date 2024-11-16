<?php

use Illuminate\Support\Facades\Route;
use Modules\Captcha\Http\Controllers\CaptchaController;

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
    Route::resource('captcha', CaptchaController::class)->names('captcha');
});
Route::post('captcha', [CaptchaController::class, 'verify'])->name('captcha.verify');
