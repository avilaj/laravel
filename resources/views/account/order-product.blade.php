<div class="order-product">

    <div class="order-product__description">
      <strong>{{ $product->product->title or  '' }} - {{ $product->product->brand->name or ''}}</strong> <br>
      <em>{{ $product->size->label or '' }} - {{ $product->reference->color->name or ''}}</em> <br>
      ${{ $product->price or ''}} x {{ $product->qty or ''}}
    </div>
</div>
