@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-product-page">
        @include('partials.product-displayer')
        <h1 class="mk-product-page__title">{{ $product->title }}</h1>
        <hr class="mk-product-page__separator">
        @if($product->specs)
        <div class="mk-product-page__specs">{!! $product->specs !!}</div>
        <hr class="mk-product-page__separator">
        @endif
        @if($product->description)
        <h3 class="mk-product-page__subtitle">Descripcion</h3>
        <div class="mk-product-page__description">{!! $product->description !!}</div>
        <hr class="mk-product-page__separator">
        @endif
        @if($sizes)
          @include('catalog.angular-references')
        @else
          <p>
            Producto fuera de stock
          </p>
        @endif
    </div>
</div>
@endsection
