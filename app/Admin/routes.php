<?php

Route::get('', ['as' => 'admin.dashboard', function () {
    $content = 'Define your dashboard here.';
    return AdminSection::view($content, 'Dashboard');
}]);
// Route::get('settings', ['as' => 'admin.settings', function () {
//     $controller = new SleepingOwl\Admin\Http\Controllers\AdminController;
//     $model = AdminSection::getModel('App\Model\Configuration');
//     return $controller->getEdit($model, 1);
// }]);

// Route::get('{adminModel}/{adminModelId}/edit', [
//     'as'   => 'model.edit',
//     'uses' => 'AdminController@getEdit',
// ]);

// Route::post('{adminModel}/{adminModelId}/edit', [
//     'as'   => 'model.update',
//     'uses' => 'AdminController@postUpdate',
// ]);
Route::get('settings', ['as' => 'admin.settings', function () {
    // \Session::flash('_redirectBack', '/admin/settings');
    // $controller = new SleepingOwl\Admin\Http\Controllers\AdminController;
    // return $controller->getEdit(AdminSection::getModel('App\Model\Configuration'), 1);
    $data = new \App\Model\Configuration;
    return AdminSection::view(view('admin.configuration', ['data' => $data]), 'Configuración del sitio');
}]);

Route::post('settings/save', ['as' => 'admin.settings.save',function ($algo = null) {
    $configuration = new \App\Model\Configuration;
    $input = Request::input();
    $configuration->fill($input);
    $configuration->save();
    return redirect()->route('admin.settings');
    // return AdminSection::view(view('admin.configuration'), 'Configuración del sitio');
}]);
// Route::post('settings', function () {
//     return var_dump(Input::request());
// });
Route::get('information', ['as' => 'admin.information', function () {
    $content = 'Define your information here.';
    return AdminSection::view($content, 'Information');
}]);