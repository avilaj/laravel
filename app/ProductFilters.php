<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Model\Category;

class ProductFilters extends QueryFilters
{
  public function brand($id) {
    return $this->builder->ofBrand($id);
  }

  public function category($id) {
    $category = Category::find($id)->getDescendantsAndSelf();
    $ids = $category->pluck('id');
    return $this->builder->whereIn('id', $ids);
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
