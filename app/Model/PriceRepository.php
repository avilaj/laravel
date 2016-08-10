<?php

namespace App\Model;

class PriceRepository
{
  public function getAll()
  {
    $url = route('products.list').'?';
    $route = \Route::current()->getName();
    $request = [];
    if ('products.list' == $route) {
      // mix the query;
      $request = \Request::all();
    }
    $list = [
      '0-100' => ['label'=>'$0 - $100'],
      '100-500' => ['label'=>'$100 - $500'],
      '500-1000' => ['label'=>'$500 - $1000'],
      '1000-2000' => ['label'=>'$1000 - $2000'],
      '2000-3000' => ['label'=>'$2000 - $3000'],
      '3000-9999' => ['label'=>'más de $3000']
    ];

    foreach ($list as $key => $value) {
      $query = ['price' => $key] + $request;
      $list[$key]['url'] = $url . http_build_query($query);;
    }

    return $list;
  }
}
