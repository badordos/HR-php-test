<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/weather/{cityId?}', 'ApiWeatherController@weather')->name('weather');

Route::group(
    ['prefix' => 'orders',],
    function () {
        Route::get('/', 'OrdersController@index')->name('orders.index');
        Route::get('/{order}', 'OrdersController@edit')->name('orders.edit');
        Route::patch('/{order}', 'OrdersController@update')->name('orders.update');
    });

Route::group(
    ['prefix' => 'products',],
    function () {
        Route::get('/', 'ProductsController@index')->name('products.index');
        Route::post('/update', 'ProductsController@update')->name('products.update');
    });



