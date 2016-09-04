<div class="product-box item">
    <a class="product-box__link" href="{{ $product->url }}" title="{{ $product->title }}">
        <img class="product-box__image" src="/{{ $product->thumbnail->small or '/placehold.it/360x360' }}" alt="{{ $product->title }}">
        <strong class="product-box__title">{{ $product->title }}</strong>
        <span class="product-box__price">${{ $product->price }}.</span>
    </a>
</div>
