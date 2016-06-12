<?php

Route::get('', ['as' => 'admin.dashboard', function () {
    $content = 'Define your dashboard here.';
    return AdminSection::view($content, 'Dashboard');
}]);
Route::get('settings', ['as' => 'admin.settings', function () {
    return AdminSection::view(view('admin.configuration'), 'Information');
}]);
Route::get('information', ['as' => 'admin.information', function () {
    $content = 'Define your information here.';
    return AdminSection::view($content, 'Information');
}]);