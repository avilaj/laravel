@extends('layouts.app')
@section('content')
 <div class="mk-news">
   <div class="mk-news__list">
     @if($news)
      @each('news.small-box', $news, 'post')
     @endif
   </div>
 </div>
 <div class="mk-paginator">
   <span class="mk-paginator__amount"><strong>{{ $news->total() }}</strong> posts</span> {!! $news->links() !!}
 </div>
@endsection
