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
            var sizes = {};
            </script>
            @foreach($references->keys() as $color)
                <script>
                    sizes["{{$color}}"] = {!!json_encode($references[$color])!!};
                </script>
                <div class="mk-product-page__references__color">
                    <label for="ref-{{ $color }}"> {{ $color }} </label>
                    <input onclick="setColor('{{ $color }}')" type="radio" name="color" id="ref-{{ $color }}" value="{{ $color }}">
                </div>
            @endforeach
            <select name="size" id="product-size-selector" class="mk-select">
                <option value=""> Seleccione talle </option>
            </select>
        </div>
        <div class="mk-product-page__sizes"></div>
        <button class="mk-product-page__purchase">Comprar</button>
        {{ $product->thumbnail }}
        {{ $product->images }}
        <p class="mk-product-page__description">{{ $product->description }}</p>
        {{ $product->specs }}
    </div>
</div>
@endsection
