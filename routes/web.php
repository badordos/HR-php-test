<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/weather/{cityId?}', 'ApiWeatherController@weather')->name('weather');
Route::get('/orders', 'OrdersController@index')->name('orders.index');
Route::get('/orders/{order}', 'OrdersController@edit')->name('orders.edit');
Route::patch('/orders/{order}', 'OrdersController@update')->name('orders.update');




