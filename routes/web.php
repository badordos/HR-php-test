<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/weather/{cityId?}', 'ApiWeatherController@weather')->name('weather');




