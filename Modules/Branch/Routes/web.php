<?php

use Illuminate\Support\Facades\Route;
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
    Route::resource('branchs', BranchController::class)->names('branchs');
});

Route::get('/select-branch', 'BranchController@selector')->name('branch.selector')->middleware('auth');
Route::post('/set-branch', 'BranchController@setBranch')->name('branch.set');
