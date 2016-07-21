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

Route::get('/', function ()
{
    return view('welcome', [
        'products' => \App\Model\Product::with('category')->get()]);
});

Route::get('/catalogo', function (Request $request)
{
    $products = Product::paginate(12);
    return view('catalog.list', [
        'products' => $products
    ])->render();
});

Route::get('/catalogo/{category_slug}',
    function (Request $request, $categorySlug) {
        $products = Product::whereHas('category',
            function ($query) use ($categorySlug)
            {
                $query->where('slug', $categorySlug) ;
            })
            ->paginate(12);

        return view('catalog.list', ['products' => $products])->render();
});

Route::get('/catalogo/{category_slug}/{product_slug}',
    function (Request $request, $categorySlug, $productSlug) {
        $product = Product::where('slug', $productSlug)->first();
        $colors = $product->colors->unique('id')->values()->all();
        $references = $product->availableReferences();
        return view('catalog.product', [
            'product'=> $product,
            'colors' => $colors,
            'references' => $references
        ]);
});

Route::get('/check-out', function () {
  $cart = App\Model\Order::currentCart();
  return view('checkout.index', [
    'items' => $cart->content(),
    'total' => $cart->total()
  ]);
});
Route::get('/check-out/proceed', function () {
  $cart = App\Model\Order::currentCart();
  $payment = App\Model\Order::CreatePayment();
  // dd($payment);
  return view('checkout.proceed', [
    'payment_link' => $payment["response"]["sandbox_init_point"],
    'items' => $cart->content(),
    'total' => $cart->total()
  ]);
});
Route::get('/check-out/set', function () {
  $reference_id = (int) Request::input('reference_id');
  $qty = (int) Request::input('qty', 1);

  if (! $reference_id) {
    return abort(400, 'Faltan parámetros.');
  }
  $cart = App\Model\Order::currentCart();
  $exists = $cart->search(function ($item) use ($reference_id) {
    return $item->id == $reference_id;
  });

  if (!($exists instanceof Illuminate\Support\Collection)) {
    $cart->update($exists->rowId, $qty);
  } else {
    if ($qty > 0) {
      $reference = Reference::with('product', 'size', 'color')->find($reference_id);
      $cart->add($reference->id,
        $reference->product->title,
        $qty,
        $reference->product->price,
        [
          'color' => $reference->color->name,
          'size'=> $reference->size->label
        ]
      );
    }
  }
  // if ($qty > 0) {
  // } else {
  //   $cart->remove($exists->rowId);
  // }
  return ['products'=>$cart->count(), 'price'=>$cart->total()];
});

Route::auth();

Route::get('/home', 'HomeController@index');
