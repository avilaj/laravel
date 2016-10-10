<?php
use Illuminate\Http\Request;

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

Route::resource('podcast', 'PodcastController', [
  'only' => ['index', 'show'],
  'names' => ['index'=> 'podcast.list', 'show'=> 'podcast.show']
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

Route::post('cart/shipping-save', [
  'uses' => 'CartController@shipping_save',
  'as' => 'cart.shipping.save'
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

Route::get('account/config', [
  'as' => 'account.config',
  'uses' => 'AccountController@config'
]);

Route::get('account/orders', [
  'as' => 'account.orders',
  'uses' => 'AccountController@orders'
]);

View::composer('partials.categories', 'App\Composers\SidebarComposer');

Route::auth();
Route::get('/', ['uses'=>'HomeController@index', 'as' => 'home']);

Route::get('locales', ['uses' => 'HomeController@stores', 'as' => 'pages.stores']);
Route::get('contacto', ['uses' => 'HomeController@contact', 'as' => 'pages.contact']);
Route::get('contacto-realizado', ['uses' => 'HomeController@contactSuccess', 'as' => 'pages.contact-success']);
Route::post('contacto', ['uses' => 'HomeController@saveContact', 'as' => 'pages.contact-save']);
Route::get('nosotros', ['uses' => 'HomeController@about', 'as' => 'pages.about']);
