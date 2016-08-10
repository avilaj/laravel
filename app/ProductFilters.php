<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class ProductFilters extends QueryFilters
{
  public function brand($id) {
    return $this->builder->ofBrand($id);
  }

  public function category($id) {
    return $this->builder->ofCategory($id);
  }

  public function price($priceRange) {
    $priceRange = explode('-', $priceRange);
    if (count($priceRange) === 2) {
      return $this->builder->priceBetween($priceRange);
    }
  }

  public function search($term) {
    return $this->builder->search($term);
  }
}
