<?php

Route::view('/', 'elevators');
Route::get('/stats', 'StatsController')->name('stats');
Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/iterations', 'IterationsController')->name('iterations');
