<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('items','Api\ItemController');
Route::resource('shopping-cart','Api\CartController');
Route::resource('orders','Api\OrderController');
//Route::get('/shopping-cart', 'CartController@index')->name('cart.index');

//Route::get('/items', 'Api\ItemController@index')->name('items.index');

