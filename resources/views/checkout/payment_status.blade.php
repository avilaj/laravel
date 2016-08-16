@extends('layouts.app')
@section('content')
<div class="checkout-page">
  <div class="checkout-page__nice-message">
    @if("approved" == $status)
    <h3 class="checkout-page__nice-message__title">
      Hemos recibido tu pedido, gracias por tu compra!
    </h3>
    <p>
      Te avisaremos cuando esté listo para enviarse.
    </p>
    @elseif("pending" == $status)
    <h3 class="checkout-page__nice-message__title">
      Tu pedido está pendiente de confirmación, gracias por tu compra!
    </h3>
    <p>
      Te avisaremos cuando esté listo para enviarse.
    </p>
    @else
    <h3 class="checkout-page__nice-message__title">
      Lo sentimos, hubo un error con tu pedido.
    </h3>
    <p>
      Intentalo nuevamente más tarde.
    </p>
    @endif
  </div>
</div>
@endsection
