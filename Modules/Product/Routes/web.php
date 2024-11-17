<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/products/print-barcode', 'BarcodeController@printBarcode')->name('barcode.print');
    //Product
    Route::resource('products', 'ProductController');
    //Product Category
    Route::resource('product-categories', 'CategoriesController')->except('create', 'show');

    // import excel
    Route::get('/import', 'ProductController@importForm')->name('products.importForm');
    Route::post('/products/import', 'ProductController@import')->name('products.import');
    Route::get('/products/search-select', 'ProductController@search')->name('products.search.select');

});

