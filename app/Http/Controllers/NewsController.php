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
        return view('news.index', ['news' => $news]);
    }

    public function show($id) {
      $post = News::findOrFail($id);
      $recentPosts = News::recent()->take(4)->get();
      $relatedProducts = \App\Model\Product::recent()->take(4)->get();
      return view('news.show', compact("post", "recentPosts", "relatedProducts"));
    }
}
