<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Subscription;

class SubscriptionsController extends Controller
{
    public function subscribe (Request $request) {
      $rules = [
        'email' => 'required|unique:subscriptions'
      ];
      $this->validate($request, $rules);
      return Subscription::create($request->all());
    }
}
