<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Order;
use Validator;


class CartController extends Controller
{
  private $cart;
  private $user;
  public function __construct() {
    $this->middleware('auth', [
      'except' => ['ipn']
    ]);
    if (\Auth::check()) {
      $this->user = \Auth::user();
      $this->cart = $this->user->currentCart();
    }

  }

  public function index (Request $request) {
    $title = "mi carro";
    return view('checkout.index', compact("title"));
  }

  public function status(Request $request) {
    $items = $this->cart->items()->with('reference.color', 'size', 'product')->get();
    $total = $this->cart->price;

    $data = compact('items', 'total');
    if ($request->wantsJson()) {
      return $data;
    }
  }

  public function shipping () {
    $title = "mi carro - envío";
    $data = array_only($this->cart->toArray(), ['address', 'postal', 'city', 'shipping_area_id']);
    $data['shipping_areas'] = \App\Model\ShippingArea::all();
    return view('checkout.shipping', $data);
  }

  public function shipping_save (Request $request) {
    $data = $request->all();

    $this->cart->address = $data['address'];
    $this->cart->postal = $data['postal'];
    $this->cart->city = $data['city'];
    $this->cart->shipping_area_id = $data['shipping_area_id'];

    if ($this->cart->save()) {
      return redirect()->route('cart.pay');
    } else {
      return redirect()->route('cart.shipping')->with('error', 'No se pudo configurar su envio.');
    }
  }

  public function pay () {
    $items = $this->cart->items()->with('reference.color', 'size', 'product')->get();
    $shipping = $this->cart->shippingarea;
    $total = $this->cart->price + $this->cart->shippingarea->price;
    $payment_link = $this->cart->CreatePayment();

    $title = "my carro - pago";
    return view('checkout.proceed', compact('items', 'total', 'payment_link', 'title', 'shipping'));
  }

  public function update(Request $request) {
    $rules = [
        'reference_id' => 'required|integer|exists:references,id',
        'size_id' => 'required|integer|exists:sizes,id',
        'qty' => '',
    ];
    $this->validate($request, $rules);
    $data = $request->input();
    $reference = \App\Model\Reference::find($data['reference_id']);
    $data['product_id'] = $reference->product_id;
    $data['price'] = $reference->product->price;

    $item = $this->cart->getItem($data['reference_id'], $data['size_id']);

    if ($item) {
      if ($data['qty'] > 0) {
        $item->qty = $data['qty'];
        $item->save();
      } else {
        $item->delete();
      }
    } else {
      $this->cart->items()->create($data);
    }

    $this->cart->updatePrice();

    $items = $this->cart->items()->with('reference.color', 'size', 'product')->get();
    $total = $this->cart->price;

    return compact('items', 'total');
  }

  public function paymentStatus(Request $request)
  {
    $data = $request->all();
    $status = $data['collection_status'];
    $title = "mi carro - finalizado";
    return view('checkout.payment_status', compact("status", "title"));
  }

}
