@extends('layouts.app')
@section('content')
<div class="checkout-page">
  <h2>Finalizar compra (paso 3 de 3)</h2>
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
            <div class="checkout-page__product__image">
              <img
              src="/{{ $item->product->thumbnail->small or '' }}"
              alt="{{ $item->product->title}} image" />
            </div>
            <div class="checkout-page__product__info">
              <h3 class="checkout-page__product__title">
                {{ $item->product->title }}
              </h3>
              <ul class="checkout-page__product__properties">
                <li> <strong>Color:</strong> {{ $item->reference->color->name }}
                <li> <strong>Talle:</strong> {{ $item->size->label }}
              </ul>
            </div>
          </div>
        <td> {{ $item->qty }}
        <td> $ {{ $item->price }}
        <td> $ {{ $item->price * $item->qty }}
      @endforeach
  </table>
  <div class="checkout-page__sidebar">
      <div class="checkout-page__shipping">
        <strong>Envio:</strong>
        {{ $shipping->name }}
        <div class="checkout-page__shipping-cost">
          ${{ $shipping->price }}
        </div>
      </div>
    Total:
    <span class="checkout-page__total">
      $ {{ $total }}
    </span>
    <br>
    <br>
    <a href="{!! $payment_link !!}" class="mk-btn mk-btn--primary mk-full-width" name="MP-Checkout" mp-mode="redirect">Seleccionar medio de pago</a>
  </div>

</div>
  <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
@endsection
