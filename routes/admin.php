<?php

use Illuminate\Support\Facades\Route;

Route::get('/shopping', 'AdminShopController@index')->name('shopping');
Route::delete('/cancel/order/{id}', 'AdminShopController@cancelOrder')->name('cancel.order');
Route::put('/accept/order/{id}', 'AdminShopController@acceptOrder')->name('accept.order');
Route::put('/delivery/change-status', 'AdminShopController@changeStatusDelivery')->name('delivery.change.status');

Route::get('/order/show-file/{id}', 'AdminShopController@showFile')->name('order.show-file');
Route::get('/discount/codes', 'AdminDiscountController@index')->name('discount.index');
Route::get('discount/create-code', 'AdminDiscountController@create')->name('discount.create');
Route::post('discount/store-code', 'AdminDiscountController@store')->name('discount.store-code');
Route::delete('discount/delete-code/{id}', 'AdminDiscountController@delete')->name('discount.delete-code');

// Route::get('/shopping', 'AdminListController@getUsers')->name('list.users');



