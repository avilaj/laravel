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
    @if($post->image)
    <div class="post-display__header-image">
      <img src="/{{ $post->image->large }}" alt="{{$post->title}}">
    </div>
    @endif
    <div class="post-display__video">
    {!! $post->content !!}
    </div>
  </div>
  @if($recentPosts)
  <div class="post-display__recent-posts">
    <h3 class="post-display__section-title">Posteos recientes</h3>
    @each('podcast.small-box', $recentPosts, 'post')
  </div>
  @endif
  @if($relatedProducts)
  <div class="post-display__related-products">
    <h3 class="post-display__section-title">Productos recientes </h3>
    @each('products.small-box', $relatedProducts, 'product')
  </div>
  @endif
</div>
@endsection
