@extends('layouts.app')
@section('content')
<div class="mk-catalog">
    @include('partials.categories')
    <div class="mk-catalog__products">
      <div class="mk-catalog__products-list">
        @each('products.small-box', $products, 'product')
      </div>
    </div>
</div>
<div class="mk-paginator">
  <span class="mk-paginator__amount"><strong>{{ $products->total() }}</strong> productos</span> {!! $products->links() !!}
</div>
@endsection
