@extends('layouts.app')
@section('content')
<div class="checkout-page">
  <table class="checkout-page__summary">
    <colgroup>
      <col class="checkout-page__summary__product"></col>
      <col class="checkout-page__summary__qty"></col>
      <col class="checkout-page__summary__price"></col>
      <col class="checkout-page__summary__subtotal"></col>
    <thead>
      <tr>
        <th> Producto
        <th> Cantidad
        <th> Precio
        <th> Subtotal
    <tbody>
      @foreach($items as $item)
      <tr>
        <td>
          <div class="checkout-page__product">
            <h3 class="checkout-page__product__title">
              {{ $item->name }}
            </h3>
            <ul class="checkout-page__product__properties">
              <li> <strong>Color:</strong> {{ $item->reference->color->name }}
              <li> <strong>Talle:</strong> {{ $item->size->label }}
            </ul>
          </div>
        <td> {{ $item->qty }}
        <td> $ {{ $item->price }}
        <td> $ {{ $item->price * $item->qty }}
      @endforeach
  </table>
  <div class="checkout-page__sidebar">
    Total:
    <span class="checkout-page__total">
      $ {{ $total }}
    </span>
    <br>
    <br>
    <a href="{!! $payment_link !!}" class="mk-btn mk-btn--primary mk-full-width" name="MP-Checkout" mp-mode="redirect">Pagar</a>
  </div>

</div>
  <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
@endsection
