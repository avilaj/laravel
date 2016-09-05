<section class="product-displayer">
    <span class="product-displayer__view">
    </span>
    <div class="product-displayer__thumbnails owl-carousel">
      @if(is_array($product->images))
      @foreach($product->images as $image)
        <div class="product-displayer__thumb item">
          <img
            src="/{{ $image->small }}"
            data-medium="/{{ $image->medium or '' }}"
            data-large="/{{ $image->large or ''}}"
            alt="thumbnail">
        </div>
      @endforeach
      @endif
    </div>
</section>
