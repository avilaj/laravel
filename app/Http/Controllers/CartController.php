<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Order;

class CartController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function index () {
    $cart = Order::currentCart();
    return view('cart.index', [
      'items' => $cart->content(),
      'total' => $cart->total()
      ]);
  }

  public function shipping () {
    return view('cart.shipping');
  }

  public function pay () {
    return view('cart.shipping');
  }

  public function update() {
    return ['message'=> 'updated'];
  }
}
