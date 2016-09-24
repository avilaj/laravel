<div class="order-product">

    <div class="order-product__description">
      <strong>{{ $product->product->title }} - {{ $product->product->brand->name }}</strong> <br>
      <em>{{ $product->size->label }} - {{ $product->reference->color->name }}</em> <br>
      ${{ $product->price }} x {{ $product->qty }}
    </div>
</div>
