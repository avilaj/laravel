@extends('layouts.app')
@section('content')
<div class="checkout-page">
  @if(count($items)>0)
    @include('checkout.angular-cart')
    <script type="text/javascript">
      var cartProducts = {!! json_encode($items->values()) !!};
    </script>
  @else
  <div class="checkout-page__nice-message">
    <h3 class="checkout-page__nice-message__title">
      Hey, no hay ningún producto en tu carrito.
    </h3>
    <p>
      Llénalo con algunos de
      <a href="{{ route('products.list') }}">nuestros productos</a>.
    </p>
  </div>
  @endif
</div>
@endsection
