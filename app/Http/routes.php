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
  $config = new \App\Model\Configuration;
  $featured = \App\Model\Product::with('category')->whereIn('id', $config->home_products)->get();
  return view('welcome', [
    'featured_products' => $featured
  ]);
});


Route::group(['prefix' => 'catalogo'], function () {
  $prices = [
    '0-100' => '$0 - $100',
    '100-500' => '$100 - $500',
    '500-1000' => '$500 - $1000',
    '1000-2000' => '$1000 - $2000',
    '2000-3000' => '$2000 - $3000',
    '3000-9999' => 'más de $3000'
  ];

  $appliedFilter = function () use ($prices) {
    $filters = [];
    $currentRoute = url()->current();
    if (Request::route()->hasParameter('category_slug')) {

      $category_slug = Request::route()
        ->getParameter('category_slug');

      $category = \App\Model\Category::whereSlug($category_slug)
        ->first();

      if ($category) {
        $filters['category'] = (object) [
          'label' => $category->name,
          'link' =>
            url('/catalogo')
            .'?'
            .http_build_query(Request::query())
        ];
      }
    }

    if(Request::has('brand')) {
      $brand = \App\Model\Brand::find(Request::input('brand'));

      if ($brand) {
        $filters['brand'] = (object) [
        'label' => $brand->name,
        'link' => $currentRoute.'?'.http_build_query(Request::except('brand'))
        ];
      }
    }

    if(Request::has('price')) {
      $filters['price'] = (object) [
        'label' => $prices[Request::input('price')],
        'link' => $currentRoute.'?'.http_build_query(Request::except('price'))
      ];
    }
    if(Request::has('search')) {
      $filters['search'] = (object) [
        'label' => Request::input('search'),
        'link' => $currentRoute.'?'.http_build_query(Request::except('search'))
      ];
    }
    return $filters;
  };

  $filter = function ($query) {
    if (Request::has('brand')) {
      $query->ofBrand(Request::input('brand'));
    }

    if (Request::has('price')) {
      $price = Request::input('price');
      $price = explode('-', $price);
      if (count($price) === 2) {
        $query->priceBetween($price);
      }
    }

    if (Request::has('search')) {
      $query->search(Request::input('search'));
    }
  };


  Route::get('/', function (Request $request)
    use ($filter, $prices, $appliedFilter)
  {
    $brands = \App\Model\Brand::all();
    $products = Product::where($filter)->paginate(12);
    return view('catalog.list', [
      'filters' => $appliedFilter(),
      'prices' => $prices,
      'brands' => $brands,
      'products' => $products
      ])->render();
  });

  Route::get('/{category_slug}',
    function (Request $request, $categorySlug)
      use ($filter, $prices, $appliedFilter)
    {
      $brands = \App\Model\Brand::all();
      $products = Product::whereHas('category',
        function ($query) use ($categorySlug)
        {
          $query->where('slug', $categorySlug) ;
        })
      ->where($filter)
      ->paginate(12);

      return view('catalog.list', [
        'filters' => $appliedFilter(),
        'prices' => $prices,
        'brands' => $brands,
        'products' => $products
        ])->render();
    });

  Route::get('/{category_slug}/{product_slug}',
    function (Request $request, $categorySlug, $productSlug)
      use ($prices)
    {
      $brands = \App\Model\Brand::all();
      $product = Product::where('slug', $productSlug)->first();
      $colors = $product->colors->unique('id')->values()->all();
      $references = $product->availableReferences();
      return view('catalog.product', [
        'prices' => $prices,
        'brands' => $brands,
        'product'=> $product,
        'colors' => $colors,
        'references' => $references
        ]);
    });
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
