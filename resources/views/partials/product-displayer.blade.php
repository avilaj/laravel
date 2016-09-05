<section class="product-displayer">
    <span class="product-displayer__view">
    </span>
    <div class="product-displayer__thumbnails owl-carousel">
      @if($product->images)
      @each('products.displayer-thumbnail', $product->images, 'image')
      @endif
    </div>
</section>
