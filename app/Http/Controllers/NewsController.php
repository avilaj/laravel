<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Model\News;

class NewsController extends Controller
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
        $news = News::paginate(12);
        $slideshow = \App\Model\Slideshow::find('default');

        $title = "novedades";
        return view('news.index', compact("news", "title", "slideshow"));
    }

    public function show($id) {
      $post = News::findOrFail($id);
      $recentPosts = News::recent()->take(4)->get();
      $relatedProducts = \App\Model\Product::recent()->take(4)->get();
      $title = "novedades - ".strtolower($post->title);
      $slideshow = \App\Model\Slideshow::find('default');

      return view('news.show', compact("post", "recentPosts", "relatedProducts", "title", "slideshow"));
    }
}
