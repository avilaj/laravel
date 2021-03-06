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
      $title = "podcast";
      $slideshow = \App\Model\Slideshow::find('default');

      return view('podcast.index', compact("posts", "title", "slideshow"));
  }

  public function show($id) {
    $post = Podcast::findOrFail($id);
    $recentPosts = Podcast::recent()->take(4)->get();
    $relatedProducts = \App\Model\Product::recent()->take(4)->get();
    $slideshow = \App\Model\Slideshow::find('default');

    $title = "podcast - ".strtolower($post->title);
    return view('podcast.show', compact("post", "recentPosts", "relatedProducts", "title", "slideshow"));
  }
}
