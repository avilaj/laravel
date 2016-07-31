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

Route::get('information', ['as' => 'admin.information', function () {
    $content = 'Define your information here.';
    return AdminSection::view($content, 'Information');
}]);
