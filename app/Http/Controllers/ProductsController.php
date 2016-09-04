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
    $data = compact("filters", "products", "title");
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
    $title = strtolower($product->title . ', ' . $product->brand->name);
    $data = compact("product", "references", "stock", "title");
    return view('catalog.product', $data);
  }

}
