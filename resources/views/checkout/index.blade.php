@extends('layouts.app')
@section('content')
  <table>
    <thead>
      <tr>
        <th>
          Product
        </th>
        <th>
          Qty
        </th>
        <th>
          Price
        </th>
        <th>
          Subtotal
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($cart as $row)
      <tr>
        <td>
          <p><strong>{{ $row->name }}</strong></p>
          <p>{{ $row->options->has('size') ? $row->options->size : '' }}</p>
        </td>
        <td><input type="number" value="{{ $row->qty }}"></td>
        <td>$ {{ $row->price }}</td>
        <td>$ {{ $row->subtotal }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ Cart::total() }}
@endsection
