<div class="order-box">
  <div class="order-box__status">
    <div class="item"><strong>Fecha:</strong> {{ $order->created_at }}</div>
    <div class="item"><strong>Orden:</strong> #{{ $order->id }}</div>
    <div class="item"><strong>Envio:</strong> {{ $order->status }}</div>
    <div class="item"><strong>Pago:</strong> {{ $order->payment_status }}</div>
  </div>
  <div class="order-box__products">
    @each('account.order-product', $order->items, 'product')
  </div>
  <div class="order-box__price">${{ $order->price }}</div>
</div>
