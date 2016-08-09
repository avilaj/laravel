<div class="post-box">
  <a href="{{ $post->url }}" class="post-box__link">
    <div class="post-box__image">
      <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
    </div>
    <div class="post-box__date">
      {{ $post->created_at->toFormattedDateString() }}
    </div>
    <div class="post-box__title">
      {{ $post->title }}
    </div>
    <div class="post-box__description">
      {{ $post->short_text }}
    </div>
  </a>
</div>
