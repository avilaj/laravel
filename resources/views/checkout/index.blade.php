@extends('layouts.app')
@section('content')
<div class="checkout-page">
  <h2>Mi orden actual (paso 1 de 3)</h2>
  @include('checkout.angular-cart')
</div>
@endsection
