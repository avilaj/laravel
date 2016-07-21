@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-product-page">
        @include('partials.product-displayer')
        <h1 class="mk-product-page__title">{{ $product->title }}</h1>
        <h2 class="mk-product-page__subtitle">{{ $product->subttitle }}</h2>
        <p class="mk-product-page__price">${{ $product->price }}.-</p>
        @include('catalog.angular-references')
        {{ $product->thumbnail }}
        {{ $product->images }}
        <p class="mk-product-page__description">{{ $product->description }}</p>
        {{ $product->specs }}
    </div>
</div>
@endsection
