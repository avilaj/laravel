<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    }

    public function stores()
    {
      return view('pages.stores');
    }

    public function contact()
    {
      return view('pages.contact');
    }

    public function saveContact(Request $request)
    {
      return $request->all();
    }
}
