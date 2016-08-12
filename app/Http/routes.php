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
use \App\Model\Product;
use \App\Model\Reference;

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

Route::get('cart/shipping', [
  'uses' => 'CartController@shipping',
  'as' => 'cart.shipping'
]);

Route::get('cart/pay', [
  'uses' => 'CartController@pay',
  'as' => 'cart.pay'
]);

Route::post('cart/update', [
  'uses' => 'CartController@update',
  'as' => 'cart.update'
]);

Route::any('gateway/ipn', [
  'uses' => 'Gateway@ipn',
  'as' => 'cart.ipn'
]);

Route::get('/', function ()
{
  $POSTS_AMOUNT = 6;

  $config = new \App\Model\Configuration;
  $brands = \App\Model\Brand::all();
  $featured = \App\Model\Product::with('category')
    ->whereIn('id', $config->home_products)->take($POSTS_AMOUNT)->get();
  $news = \App\Model\News::featured()->take($POSTS_AMOUNT)->get();
  $recentProducts = \App\Model\Product::with('category')->latest()->get();
  return view('welcome', [
    'news' => $news,
    'brands' => $brands,
    'featured_products' => $featured,
    'recent_products' => $recentProducts
  ]);
});

View::composer('partials.categories', 'App\Composers\SidebarComposer');

Route::auth();

Route::get('/home', 'HomeController@index');
