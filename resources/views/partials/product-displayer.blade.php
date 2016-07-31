<section class="product-displayer">
    <span class="product-displayer__view">
      @if(isset($product->medium_images))
        <img src="/{{$product->medium_images[0]}}" alt="preview">
      @endif
    </span>
    <div class="product-displayer__thumbnails owl-carousel">
      @if(isset($product->small_images))
      @foreach($product->small_images as $index => $image)
        <div class="product-displayer__thumb item">
          <img
            src="/{{ $image }}"
            data-medium="/{{$product->medium_images[$index]}}"
            data-large="/{{$product->large_images[$index]}}"
            alt="thumbnail">
        </div>
      @endforeach
      @endif
    </div>
</section>
