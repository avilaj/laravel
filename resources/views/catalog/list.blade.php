@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-catalog__products">
        @foreach ($products as $product)
          @include('products.small-box')
        @endforeach
    </div>
</div>
<div class="mk-paginator">
	<span class="mk-paginator__amount"><strong>{{ $products->total() }}</strong> productos</span> {!! $products->links() !!}
</div>
@endsection
