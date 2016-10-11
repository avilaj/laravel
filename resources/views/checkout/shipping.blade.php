@extends('layouts.app')
@section('content')
<div class="checkout-page">
  <h2>Configuración de envío (paso 2 de 3)</h2>
  <form class="shipping-form" action="{{ route('cart.shipping.save') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="address" value="{{$address or ''}}" placeholder="Dirección">
    <input type="text" name="postal" value="{{$postal or ''}}" placeholder="Código postal">
    <input type="text" name="city" value="{{$city or ''}}" placeholder="Ciudad">
    <select name="shipping_area_id" >
      <option
      @if(!$shipping_area_id)
        selected
      @endif
      disabled>--Area de entrega--</option>
      @if (isset($shipping_areas) && count($shipping_areas))
      @foreach($shipping_areas  as $area)
      <option value="{{$area->id}}"
        @if($area->id == $shipping_area_id )
        selected
        @endif
        >
        {{$area->name}} (${{$area->price}})
      </option>
      @endforeach
      @endif
    </select>
    <button type="submit" class="mk-btn mk-btn--primary mk-full-width" name="button">Siguiente</button>
  </form>
</div>
@endsection
