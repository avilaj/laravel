<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \App\Model\Podcast;


class PodcastController extends Controller
{
  public function index()
  {
      $posts = Podcast::paginate(12);
      return view('podcast.index', ['posts' => $posts]);
  }

  public function show($id) {
    $post = Podcast::findOrFail($id);
    $recentPosts = Podcast::recent()->take(4)->get();
    $relatedProducts = \App\Model\Product::recent()->take(4)->get();
    return view('podcast.show', compact("post", "recentPosts", "relatedProducts"));
  }
}
