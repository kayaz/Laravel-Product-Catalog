<?php
// Login
Route::get('login',                             'Auth\LoginController@showLoginForm')->name('login');
Route::post('login',                            'Auth\LoginController@login');
Route::post('logout',                           'Auth\LoginController@logout')->name('logout');

// Catalog
Route::get('/',                         'IndexController@index')->name('catalog.index');

// Product
Route::get('/{slug}',                   'IndexController@show')->name('catalog.product');

// Admin
Route::group(['prefix'=>'/product/', 'as' => 'admin.product.', 'middleware' => 'auth'], function() {

    Route::get('add',                    'IndexController@create')->name('add');
    Route::post('store',                 'IndexController@store')->name('store');
    Route::delete('delete/{products}',   'IndexController@destroy')->name('delete');

});
