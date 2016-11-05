<?php

namespace App\Composers;

use App\Model\PriceRepository;
use App\Model\FilterRepository;
use App\Model\Category;
use App\Model\Brand;

class SidebarComposer
{
  public function __construct(PriceRepository $prices, FilterRepository $filters)
  {
    $this->prices = $prices;
    $this->filters = $filters;
  }

  public function compose($view) {
    $view->with([
      'filters' => $this->filters->getAll(),
      'prices' => $this->prices->getAll(),
      'categories' => Category::all(),
      'brands' => Brand::all()->orderBy('name', 'ASC')
    ]);
  }
}
