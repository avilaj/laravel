@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-product-page">
        @include('partials.product-displayer')
        <h1 class="mk-product-page__title">{{ $product->title }}</h1>
        <h2 class="mk-product-page__subtitle">{{ $product->subttitle }}</h2>
        <p class="mk-product-page__description">{!! $product->description !!}</p>
        <p class="mk-product-page__price">${{ $product->price }}.-</p>
        @if($sizes)
          @include('catalog.angular-references')
        @else
          <p>
            Producto fuera de stock
          </p>
        @endif
        {{ $product->specs }}
    </div>
</div>
@endsection
