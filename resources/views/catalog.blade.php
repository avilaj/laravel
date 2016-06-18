@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-catalog__products">
        @foreach ($products as $product)
        <div class="productBox item">
            <a class="productBox__link" href="{{ $product->url }}" title="{{ $product->title }}">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="{{ $product->title }}">
                <strong class="productBox__title">{{ $product->title }}</strong>
                <span class="productBox__price">${{ $product->price }}.</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="mk-paginator">
	<span class="mk-paginator__amount"><strong>{{ $products->total() }}</strong> productos</span> {!! $products->links() !!}
</div>
@endsection