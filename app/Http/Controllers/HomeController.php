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
      $featured_products = \App\Model\Product::with('category')
        ->whereIn('id', $config->home_products)->take($POSTS_AMOUNT)->get();
      $news = \App\Model\News::featured()->take($POSTS_AMOUNT)->get();
      $recent_products = \App\Model\Product::with('category')->latest()->get();
      $title = "super online store";
      return view('welcome', compact(
        "title",
        "slideshow",
        "news",
        "brands",
        "featured_products",
        "recent_products"
      ));
    }

    public function stores()
    {
      $title = "locales";
      $slideshow = \App\Model\Slideshow::find('default');

      return view('pages.stores', compact("title", "slideshow"));
    }

    public function contact()
    {
      $title = "contactanos";
      $slideshow = \App\Model\Slideshow::find('default');

      return view('pages.contact', compact("title", "slideshow"));
    }

    public function contactSuccess()
    {
      $title = "gracias por tu contacto";
      return view('pages.contact-success', compact("title"));
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
