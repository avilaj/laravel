<?php

namespace App\Model;

class FilterRepository
{
  public function getAll()
  {
    $query = \Request::all();
    $list = [];

    foreach ($query as $name => $value) {
      if (! method_exists($this, $name)) {
        continue;
      }

      if (strlen($value)) {;
        $list[] = $this->$name($value);
      }

    }

    return $list;
  }
  public function getUrlWithout($param) {
    $parameters =  request()->all();
    $query = array_except($parameters, [$param]);
    $url = route('products.list').'?'.http_build_query($query);
    return $url;
  }
  public function brand($id)
  {
    $brand = \App\Model\Brand::find($id);
    if(! $brand) return;

    $label = 'Marca: '.$brand->name;
    $url = $this->getUrlWithout('brand');
    return compact('label', 'url');
  }

  public function price($range)
  {
    $limits = explode('-',$range);
    if(2 != count($limits)) return;

    $label = 'Precio: '. $limits[0].'-'.$limits[1];
    $url = $this->getUrlWithout('price');
    return compact('label', 'url');
  }

  public function category($id)
  {
    $category = \App\Model\Category::find($id);
    if(! $category) return;

    $label = 'Categoría: '.$category->name;
    $url = $this->getUrlWithout('category');
    return compact('label', 'url');
  }

  public function search($term)
  {
    $label = 'Búsqueda: '.$term;
    $url = $this->getUrlWithout('search');
    return compact('label', 'url');
  }
}
