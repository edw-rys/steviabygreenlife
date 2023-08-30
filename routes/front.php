<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontController@index')->name('front.index');
Route::get('/front','FrontController@front');

/**
 * Cart
 */
Route::get('/front/cart','CartController@cart');


Route::get('/store','ShopController@index')->name('front.shop');
Route::get('/store/category/{category_name}','ShopController@index')->name('front.shop.category');
Route::get('/store/product/{id}','ShopController@show')->name('front.shop.show');
Route::post('/store/product/{id}/add-to-cart','ShopController@show')->name('front.shop.add-to-cart');


Route::get('/store/cart/show','CartController@show')->name('front.cart.show');
Route::get('/store/cart/checkout','CartController@show')->name('front.cart.checkout');

// api
Route::get('/store/cart/get-items','CartController@show')->name('front.cart.get-items');


// Auth

Route::get('/auth/register', 'AuthController@registerShow')->name('auth.register');
Route::get('/auth/login', 'AuthController@loginShow')->name('auth.login');
Route::get('/auth/forgot-your-password', 'AuthController@forgorYourPasswordShow')->name('front.forgotyourpassword');

Route::post('/auth/login', 'AuthController@login')->name('auth.login.post');

