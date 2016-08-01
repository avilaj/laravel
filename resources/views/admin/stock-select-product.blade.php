<h3>Seleccionar producto</h3>
@foreach($products as $product)
<a href="{{route('admin.add-stock', $product->id)}}" class="btn btn-default">{{ $product->title }}</a>
@endforeach
