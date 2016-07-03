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
        $colors = $product->colors->unique('id')->lists('name', 'id');
        $references = $product->availableReferences();
        return view('catalog.product', [
            'product'=> $product,
            'colors' => $colors,
            'references' => $references
        ]);
});

Route::get('/check-out', function () {
  return view('checkout.index', ['cart' => Cart::content() ]);
});

Route::get('/check-out/add', function () {
  if (! Request::input('reference_id')) {
    return error(400);
  }
  $reference = Reference::with('product', 'size', 'color')->find(Request::input('reference_id'));
  $qty = Request::input('qty', 1);
  Cart::add($reference->id, $reference->product->title, $qty, $reference->product->price, ['color' => $reference->color->name, 'size'=> $reference->size->label]);
  return ['products'=>Cart::count(), 'price'=>Cart::total()];
});

Route::auth();

Route::get('/home', 'HomeController@index');
