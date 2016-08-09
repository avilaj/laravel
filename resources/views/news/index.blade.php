@extends('layouts.app')
@section('content')
 <div class="mk-news">
   <div class="mk-news__list">
     @if(isset($news) and count($news) > 0)
       @foreach($news as $post)
        @include('news.small-box')
       @endforeach
     @endif
   </div>
   {!! $news->render() !!}
 </div>
@endsection
