<?php

Route::get('', ['as' => 'admin.dashboard', function () {
    $content = 'Define your dashboard here.';
    return AdminSection::view($content, 'Dashboard');
}]);

Route::get('settings', ['as' => 'admin.settings', function () {
    $data = new \App\Model\Configuration;
    $products = \App\Model\Product::get()->lists('title', 'id')->toArray();
    return AdminSection::view(view('admin.configuration',
      ['data' => $data, 'products' => $products]
    ), 'Configuración del sitio');
}]);

Route::post('settings/save', ['as' => 'admin.settings.save',function ($algo = null) {
    $configuration = new \App\Model\Configuration;
    $input = Request::input();
    $configuration->fill($input);
    $configuration->save();
    return redirect()->route('admin.settings');
}]);

Route::get('add-stock/select-product', ['as'=>'admin.add-stock.select-product', function (Request $request) {
  $products = \App\Model\Product::with('references', 'colors')->get();
  $products = AdminDisplay::table()
    ->setModelClass(\App\Model\Product::class)
    ->setColumns([
      AdminColumn::text('title', 'Producto'),
      AdminColumn::custom()
        ->setLabel('')
        ->setCallback(function ($instance) {
          $link = route('admin.add-stock', $instance->id);
          $elem = '<a class="btn btn-default" href="'.$link.'">Actualizar Stock</a>';
          return $elem;
        })
      ]);

  $products->initialize();
  $view = $products->render();
  $view->creatable = false;
  $view->title = 'Registrar movimiento de inventario';
  $columns = $view->extensions->get('columns');
  $control = AdminColumn::control();
  $columns->setControlColumn($control);

  return AdminSection::view($view);
}]);
Route::get('add-stock/{product_id}', ['as'=>'admin.add-stock', function (Request $request, $product_id) {
  $product = App\Model\Product::find($product_id);
  if (!$product) return abort(404);
  $sizes = $product->type->sizes;
  $references = $product->references;
  return AdminSection::view(view('admin.stock',
    [
      'sizes' => $sizes,
      'references' => $references,
      'product' => $product
  ]
  ), 'Añadir stock');
}]);

Route::post('add-stock/{product_id}', ['as' => 'admin.add-stock.save', function (Request $request, $product_id) {
  $data = Request::input();
  $store = function ($size_id, $amount) use ($product_id, $data) {
    $amount = (int) $amount;
    if ($amount == 0) return;
    App\Model\Stock::create([
      'reference_id' => $data['reference_id'],
      'size_id' => $size_id,
      'message' => $data['message'],
      'qty' => $amount
    ]);
  };
  array_map($store, array_keys($data['sizes']), $data['sizes']);
  return redirect('admin/stock');
}]);

Route::get('information', ['as' => 'admin.information', function () {
    $content = 'Define your information here.';
    return AdminSection::view($content, 'Information');
}]);
