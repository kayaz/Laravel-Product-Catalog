<?php
// Login
Auth::routes();

// Admin
Route::group(['as' => 'product.'], function() {

    Route::get('/',                                 'ProductController@index')->name('index');
    Route::get('/{slug}',                           'ProductController@show')->name('show');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/product/create',               'ProductController@create')->name('create');
        Route::post('/product',                     'ProductController@store')->name('store');
        Route::delete('/product/{product}',         'ProductController@destroy')->name('delete');
    });
});
