<?php

use Modules\Product\Http\Controllers\ProductController;
use Modules\Public\Http\Controllers\CheckoutController;
use Modules\Public\Http\Controllers\PageController;

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

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest');


Route::get('/', 'PageController@home')->name('public.home');
Route::get('/blog', 'PageController@blog')->name('public.blog');
Route::get('/blog/{post:slug}', 'PageController@detailblog')->name('public.blog-detail');
Route::get('/store', 'PageController@store')->name('public.store');
Route::get('/product/{product:product_slug}', 'PageController@detailstore')->name('public.product-detail');
Route::get('/about', 'PageController@about')->name('public.about');
// detail blog sebenernya
Route::get('/blog-detail/{post:slug}', 'PageController@BlogDetail')->name('public.BlogDetail');

Route::get('/tes', function () {
    return view('public::beranda');
});

Route::get('/pricing', function () {
    return view('public::pricing');
});
Route::get('/testimoni', function () {
    return view('public::testimoni');
});
Route::get('/product', 'PageController@ProductPage')->name('public.productPage');
Route::get('/search-products', 'PageController@search')->name('products.search');
Route::get('/panduan', function () {
    return view('public::panduan');
});

// Route untuk detail produk
Route::get('/products-detail/{product}', [PageController::class, 'detailProduct'])->name('products.detail');

// Route untuk checkout (sesuai dengan link di template)
Route::get('/checkout/{product}', [CheckoutController::class, 'checkout'])->name('checkout');

// handle seteleh pembayaran
Route::get('/payment/success/{transaction}/{productId}', [CheckoutController::class, 'showPaymentSuccess'])->name('payment.success');
Route::post('/payment/notification', [CheckoutController::class, 'handleNotification'])->name('payment.notification');
Route::get('/products/load-more', [PageController::class, 'loadMore'])->name('products.loadMore');
