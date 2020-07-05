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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/store', 'HomeController@store')->name('store');
Route::get('/items', 'ItemController@index')->name('items.index');
//Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
//Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/addToCart/{item}', 'CartController@store')->name('cart.store');
Route::get('/shopping-cart', 'CartController@index')->name('cart.index');
Route::delete('/deleteCart/{cart}', 'CartController@destroy')->name('cart.delete');
Route::put('/updateCart/{cart}', 'CartController@update')->name('cart.update');

Route::get('/checkout/{amount}', 'CartController@checkout')->name('cart.checkout');
Route::post('cart/charge', 'OrderController@store')->name('cart.charge');

Route::get('/orders', 'OrderController@index')->name('order.index');


//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
