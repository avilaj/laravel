  <div class="post-box">
  <a href="{{ $post->url }}" class="post-box__link">
    <div class="post-box__image">
      <img src="/{{ $post->image->small }}" alt="{{ $post->title }}">
    </div>
    <div class="post-box__date">
      {{ $post->created_at->formatLocalized('%d %B') }}
    </div>
    <div class="post-box__title">
      {{ $post->title }}
    </div>
  </a>
</div>
