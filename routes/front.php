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
Route::get('/terminos-y-condiciones','FrontController@terms')->name('front.terms');

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
Route::get('/store/cart/checkout/{token}','CartController@checkout')->name('front.cart.checkout');
Route::post('/store/cart/save-checkout','CartController@processCheckout')->name('front.cart.save-checkout');
Route::post('/store/cart/save-transfer','CartController@saveTransfer')->name('front.cart.save-solicitud-transfer');

// PAY
Route::get('/store/process-pay','CartController@checkPay')->name('front.process-pay');
Route::get('/store/process-result-pay/{transaction}','CartController@resultPay')->name('front.result.pay');
Route::get('/store/process-error-pay','CartController@showErrorPay')->name('front.result.error_pay');

Route::put('/store/cart/billing/change-city','CartController@changeCityRecalculateDelivery')->name('front.cart.billing.change-city');

// api
Route::get('/store/cart/get-items','CartController@getMyItems')->name('front.cart.get-items');
Route::post('/store/cart/add-product', 'CartController@addProduct')->name('front.cart.add-item');
Route::post('/store/cart/change-items-counts', 'CartController@changeItemsProducts')->name('front.cart.change-items-count');
Route::get('/store/cart/reload-items', 'CartController@getReloadItems')->name('front.cart.reload-items');
Route::delete('/store/cart/remove-item', 'CartController@removeItem')->name('front.cart.remote-item');



// Global
Route::get('/utils/get-county','UtilsController@getCountries')->name('utils.get-country');
Route::get('/utils/get-states/{country_id}','UtilsController@getStates')->name('utils.get-states');
Route::get('/utils/get-cities/{state_id}','UtilsController@getCities')->name('utils.get-cities');



Route::middleware(['IsNoAuthenticated'])->group(function () {
    // Auth
    Route::get('/auth/register', 'AuthController@registerShow')->name('auth.register');
    Route::get('/auth/login', 'AuthController@loginShow')->name('auth.login');
    // Route::get('/auth/login', 'AuthController@loginShow')->name('login');
    Route::get('/auth/forgot-your-password', 'AuthController@forgorYourPasswordShow')->name('front.forgotyourpassword');
    
    Route::post('/auth/login', 'AuthController@login')->name('auth.login.post');
    Route::post('/auth/signup', 'AuthController@signup')->name('auth.signup.post');


    Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post'); 
    Route::get('reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');
});


Route::middleware(['auth'])->group(function () {
    Route::get('user/logout', 'AuthController@logout')->name('user.logout');
    
    
    Route::get('user/perfil', 'UserController@profile')->name('user.profile');
    Route::get('user/favoritos', 'ClientController@favorites')->name('user.favorites');
    Route::post('user/favoritos/{id}/add', 'ClientController@addFavorites')->name('user.favorites.add');
    Route::get('user/mis-compras', 'ClientController@shopping')->name('user.shopping');
    Route::get('user/change-password', 'UserController@changePassword')->name('user.change-password');

    Route::post('user/perfil/save', 'UserController@updateProfile')->name('user.profile.save');
    Route::post('user/change-password/save', 'UserController@updatePassword')->name('user.change-password.save');
});



