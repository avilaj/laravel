@extends('layouts.app')
@section('content')
 <div class="mk-news">
   <div class="mk-news__list">
     @if($posts)
      @each('podcast.small-box', $posts, 'post')
     @endif
   </div>
 </div>
 <div class="mk-paginator">
   <span class="mk-paginator__amount"><strong>{{ $posts->total() }}</strong> posts</span> {!! $posts->links() !!}
 </div>
@endsection
