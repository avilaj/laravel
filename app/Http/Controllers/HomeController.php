<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Model\Message;

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
      $slideshow = \App\Model\Slideshow::find('home');
      $config = new \App\Model\Configuration;
      $brands = \App\Model\Brand::all();
      $featured = \App\Model\Product::with('category')
        ->whereIn('id', $config->home_products)->take($POSTS_AMOUNT)->get();
      $news = \App\Model\News::featured()->take($POSTS_AMOUNT)->get();
      $recentProducts = \App\Model\Product::with('category')->latest()->get();
      return view('welcome', [
        'slideshow' => $slideshow,
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

    public function contactSuccess()
    {
      return view('pages.contact-success');
    }

    public function saveContact(Request $request)
    {
      $rules = [
        'name'=> 'required',
        'email' => 'required|email',
        'message' => 'required|max:256',
      ];
      $this->validate($request, $rules);
      $message = Message::create($request->all());
      if ($message) {
        return redirect(route('pages.contact-success'))->with('name', $request->input('name'));
      } else {
        return abort(400);
      }
    }
}
