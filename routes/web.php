<?php
// Login
Auth::routes();

//Home
Route::get('/home',                                 'HomeController@index')->name('index');

// Admin
Route::group(['as' => 'product.'], function() {

    Route::get('/',                                 'ProductController@index')->name('index');
    Route::get('/{slug}',                           'ProductController@show')->name('show');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/product/create',               'ProductController@create')->name('create');
        Route::get('/product/{products}/edit',       'ProductController@edit')->name('edit');
        Route::post('/product',                     'ProductController@store')->name('store');
        Route::delete('/product/{products}',         'ProductController@destroy')->name('delete');
        Route::put('/product/{products}',            'ProductController@update')->name('update');
    });
});
