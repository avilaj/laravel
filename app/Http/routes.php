<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('novedades', 'NewsController', [
  'only' => ['index', 'show'],
  'names' => ['index'=> 'news.list', 'show'=> 'news.show']
]);

Route::resource('productos', 'ProductsController', [
  'only' => ['index', 'show'],
  'names' => ['index' => 'products.list', 'show' => 'products.show']
]);

Route::get('cart', [
  'uses' => 'CartController@index',
  'as' => 'cart.index'
]);

Route::get('cart/status', [
  'uses' => 'CartController@status',
  'as' => 'cart.status'
]);

Route::get('cart/shipping', [
  'uses' => 'CartController@shipping',
  'as' => 'cart.shipping'
]);

Route::get('cart/pay', [
  'uses' => 'CartController@pay',
  'as' => 'cart.pay'
]);

Route::get('cart/payment_status', [
  'uses' => 'CartController@paymentStatus',
  'as' => 'cart.payment-status'
]);

Route::post('cart/update', [
  'uses' => 'CartController@update',
  'as' => 'cart.update'
]);

Route::any('gateway/ipn', [
  'uses' => 'Gateway@ipn',
  'as' => 'cart.ipn'
]);

Route::get('gateway/payment/{id}', [
  'uses' => 'Gateway@showPayment',
  'as' => 'gateway.showPayment'
]);

Route::get('gateway/order/{id}', [
  'uses' => 'Gateway@showOrder',
  'as' => 'gateway.showOrder'
]);

Route::post('subscriptions', [
  'as' => 'subscriptions.create',
  'uses' => 'SubscriptionsController@subscribe'
]);

View::composer('partials.categories', 'App\Composers\SidebarComposer');

Route::auth();
Route::get('/', ['uses'=>'HomeController@index', 'as' => 'home']);
