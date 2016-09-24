<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Model\User;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
      $this->user = \Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {

      return view('account.config');
    }

    public function orders() {
      $orders = $this->user->orders()
        ->with('items', 'items.reference','items.size', 'items.product')
        ->where('status','!=', NULL)
        ->recent()
        ->get();
      $data = compact('orders');
      return view('account.orders', $data);
    }
}
