<?php

use App\Models\CartShop;
use App\Service\CartProductService;
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

// Route::get('random', function(){
//     echo generateRandomString(75);
// });

// Route::get('find-cart', function(CartProductService $cartProductService){
//     $cart = CartShop::with(['products', 'products.product'])->find(26);
//     $cartProductService->restoreCart($cart);
//     dd($cart->toArray());
// });