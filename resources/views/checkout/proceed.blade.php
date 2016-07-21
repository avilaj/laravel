@extends('layouts.app')
@section('content')
  @if(count($items) > 0)
    @foreach($items as $item)
      <p>
        <strong>{{ $item->name }}</strong> <br> {{ $item->options->color }} - {{ $item->options->size }} <br> {{ $item->qty }} {{ $item->price }}
      </p>
    @endforeach
    <p>
      <strong>{{ $total }}</strong>
    </p>
  @endif
  <a href="{!! $payment_link !!}" name="MP-Checkout">Comprar</a>
  <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
@endsection
