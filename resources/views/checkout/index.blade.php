@extends('layouts.app')
@section('content')
<div class="checkout-page">
  @if(count($items)>0)
    @include('checkout.angular-cart')
    <script type="text/javascript">
      var cartProducts = {!! json_encode($items->values()) !!};
    </script>
  @else
  No cart is here
  @endif
</div>
@endsection
