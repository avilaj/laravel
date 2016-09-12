<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Product;
use App\ProductFilters;

class ProductsController extends Controller
{

  public function index (ProductFilters $query) {
    $title = 'productos';
    $products = Product::filter($query)->paginate(12);
    $slideshow = \App\Model\Slideshow::find('default');
    $data = compact("filters", "products", "title", "slideshow");
    return view('catalog.list', $data);
  }

  public function show ($id) {
    $product = Product::findOrFail($id);
    $references = $product->references()
      ->join('colors', 'references.color_id', '=', 'colors.id')
      ->select('references.id','references.color_id', 'colors.name')->get();
    $references_id =  $references->lists('id')->toArray();
    $stock = \App\Model\Stock::forDisplay()
      ->whereIn('reference_id', $references_id)
      ->get();
    $title = $product->title;
    $title.= $product->brand? ', '.$product->brand->name : '';
    $title = strtolower($title);
    $slideshow = \App\Model\Slideshow::find('default');
    $data = compact("product", "references", "stock", "title", "slideshow");
    return view('catalog.product', $data);
  }

}
