@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-product-page">
        @include('partials.product-displayer')
        <h1 class="mk-product-page__title">{{ $product->title }}</h1>
        <h2 class="mk-product-page__subtitle">{{ $product->subttitle }}</h2>
        <p class="mk-product-page__price">${{ $product->price }}.-</p>
        <div class="mk-product-page__references">
            <script>
              var sizes = {!!json_encode($references)!!};
            </script>
            @foreach($colors as $colorId =>$color)
                <div class="mk-product-page__references__color">
                    <label for="ref-{{ $color }}"> {{ $color }} </label>
                    <input onclick="setColor('{{ $colorId }}')" type="radio" name="color" id="ref-{{ $color }}" value="{{ $color }}">
                </div>
            @endforeach
            <select name="size" id="product-size" class="mk-select">
                <option value=""> Seleccione talle </option>
            </select>
        </div>
        <input type="number" name="qty" value="1" id="product-qty">
        <button class="mk-product-page__purchase" id="product-add-to-cart" onclick="addToCart()">Comprar</button>
        {{ $product->thumbnail }}
        {{ $product->images }}
        <p class="mk-product-page__description">{{ $product->description }}</p>
        {{ $product->specs }}
    </div>
</div>
@endsection
