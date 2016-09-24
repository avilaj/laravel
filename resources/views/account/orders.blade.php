@extends('layouts.app')

@section('content')
<div class="mk-account-orders">
  <h2>Mis ordenes</h2>
  <div class="mk-account-orders-list">
    @each('account.order-box', $orders, 'order', 'account.orders-empty')
  </div>


</div>
@endsection
