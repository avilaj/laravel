<?php

namespace App\Http\Controllers;

use App\Http\Requests;
// use Illuminate\Http\Request;
use App\Model\Product;
use App\ProductFilters;

class ProductsController extends Controller
{
  public function index (ProductFilters $query) {
    $products = Product::filter($query)->paginate(12);
    $data = compact("filters", "products");
    return view('catalog.list', $data);
  }

  public function show($id) {

    $product = Product::findOrFail($id);
    $references = $product->references()->forDisplay();
    $stock = $product->availableReferences();
    $data = compact("stock", "product", "references");
    $response = new \Illuminate\Http\JsonResponse($data);
    $response->setJsonOptions(JSON_PRETTY_PRINT);
    return $response;
    // dd($data);
  }
}
