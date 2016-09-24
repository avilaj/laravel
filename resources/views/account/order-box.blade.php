<div class="order-box">
  <div class="order-box__date"><strong>Fecha:</strong> {{ $order->created_at }}</div>
  <div class="order-box__status">
    <div class="order-box__shipment"><strong>Envio:</strong> {{ $order->status }}</div>
    <div class="order-box__payment"><strong>Pago:</strong> {{ $order->payment_status }}</div>
  </div>
  <div class="order-box__products">
    @each('account.order-product', $order->items, 'product')
  </div>
  <div class="order-box__price">${{ $order->price }}</div>
</div>
