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

Route::get('cart/gateway/confirm_payment', [
  'uses' => 'CartController@ipn',
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

Route::get('/check-out', function () {
  $cart = App\Model\Order::currentCart();
  return view('checkout.index',[
    'items' => $cart->content(),
    'total' => $cart->total()
    ]);
});
Route::get('/check-out/proceed', function () {
  $cart = App\Model\Order::currentCart();
  $payment = App\Model\Order::CreatePayment();

  return view('checkout.proceed', [
    'payment_link' => $payment["response"]["sandbox_init_point"],
    'items' => $cart->content(),
    'total' => $cart->total()
    ]);
});
Route::get('/check-out/set', function () {
  $reference_id = (int) Request::input('reference_id');
  $size_id = (int) Request::input('size_id');
  $qty = (int) Request::input('qty', 1);
  if (! $reference_id || ! $size_id) {
    return abort(400, 'Faltan parámetros.');
  }

  $identificator = md5($reference_id .'-'.$size_id);

  $cart = App\Model\Order::currentCart();
  $exists = $cart->search(function ($item) use ($identificator) {
    return $item->id == $identificator;
  });

  if (!($exists instanceof Illuminate\Support\Collection)) {
    $cart->update($exists->rowId, $qty);
  } else {
    if ($qty > 0) {
      $reference = Reference::with('product', 'color')->find($reference_id);
      if (!$reference) return abort(400);
      $size = \App\Model\Size::find($size_id);
      if (!$size) return abort(400);

      $cart->add($identificator,
        $reference->product->title,
        $qty,
        $reference->product->price,
        [
          'product_id' => $reference->product->id,
          'reference_id' => $reference->id,
          'color_id' => $reference->color_id,
          'size_id' => $size_id,
          'color' => $reference->color->name,
          'size'=> $size->label
        ]
        );
    }
  }
  return ['products'=>$cart->count(), 'price'=>$cart->total()];
});

Route::auth();

Route::get('/home', 'HomeController@index');
