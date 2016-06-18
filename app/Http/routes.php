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

Route::get('/', function ()
{
    return view('welcome', [
        'products' => \App\Model\Product::with('category')->get()]);
});

Route::get('/catalogo', function (Request $request)
{
    $products = \App\Model\Product::paginate(12);
    return view('catalog', [
        'products' => $products
    ])->render();
});

Route::get('/catalogo/{category_slug}', function (Request $request,
                                                  $categorySlug)
{
    $products = Product::whereHas('category',
        function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug) ;
        })
        ->paginate(12);

    return view('catalog',
        [
            'products' => $products
        ])
        ->render();
});
Route::auth();

Route::get('/home', 'HomeController@index');
