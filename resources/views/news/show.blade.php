@extends('layouts.app')
@section('content')
<div class="post-display">
  <div class="post-display__content">
    <div class="post-display__date">
      {{ $post->created_at->toFormattedDateString() }}
    </div>
    <h1 class="post-display__title">
      {{ $post->title }}
    </h1>
    <div class="post-display__header-image">
      <img src="{{$post->thumbnail('large')}}" alt="{{$post->title}}">
    </div>
    <div class="post-display__text">
      {!! $post->text !!}
    </div>
    <div class="post-display__gallery">
      @if(isset($post->gallery) && count($post->gallery) > 0)
      @foreach($post->gallery as $image)
      <div class="post-display__gallery-item">
        <img src="{{ $image }}" alt="Gallery image" />
      </div>
      @endforeach
      @endif
    </div>
  </div>
  <div class="post-display__recent-posts">
    <h3 class="post-display__section-title">Posteos recientes</h3>
    @if(isset($recentPosts) &&count($recentPosts) > 0)
    @foreach($recentPosts as $post)
    @include('news.small-box')
    @endforeach
    @endif
  </div>
  <div class="post-display__related-products">
    <h3 class="post-display__section-title">Productos relacionados </h3>
    @if(isset($relatedProducts) &&count($relatedProducts) > 0)
    @foreach($relatedProducts as $product)
    @include('products.small-box')
    @endforeach
    @endif
  </div>
</div>
@endsection
