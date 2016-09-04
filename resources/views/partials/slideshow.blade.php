@if ($slides && count($slides))
<div class="mk-slideshow owl-carousel">
@foreach ($slides as $slide)
  <div class="mk-slideshow__slide">
    <a href="{{ $slide->url or '#' }}">
      <img src="/{{ $slide->large or '' }}" />
    </a>
  </div>
@endforeach
</div>
@endif
