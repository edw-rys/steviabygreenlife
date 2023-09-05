<?php

use Illuminate\Support\Facades\Route;

Route::get('/shopping', 'AdminShopController@index')->name('shopping');
Route::delete('/cancel/order/{id}', 'AdminShopController@cancelOrder')->name('cancel.order');
Route::put('/delivery/change-status', 'AdminShopController@changeStatusDelivery')->name('delivery.change.status');



