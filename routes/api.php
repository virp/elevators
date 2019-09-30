<?php

Route::get('/elevators/state', 'ElevatorsStateController');
Route::post('/orders', 'OrdersController@store');
