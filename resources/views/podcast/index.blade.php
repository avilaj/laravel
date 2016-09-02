@extends('layouts.app')
@section('content')
 <div class="mk-news">
   <div class="mk-news__list">
     @if(isset($posts) and count($posts) > 0)
       @foreach($posts as $post)
        @include('podcast.small-box')
       @endforeach
     @endif
   </div>
 </div>
 <div class="mk-paginator">
   <span class="mk-paginator__amount"><strong>{{ $posts->total() }}</strong> posts</span> {!! $posts->links() !!}
 </div>
@endsection
