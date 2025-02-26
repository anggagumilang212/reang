<?php

use Illuminate\Support\Facades\Route;
use Modules\ClosingKasir\Http\Controllers\ClosingKasirController;
use Modules\Branch\Http\Controllers\BranchController;

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
    Route::resource('closingkasir', ClosingKasirController::class)->names('closingkasir');
});


Route::get('/closing-kasir/{tanggal}', [ClosingKasirController::class, 'show'])->name('closing-kasir.show');
