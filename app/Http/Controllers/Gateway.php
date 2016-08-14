<?php
namespace App\Http\Controllers;

use Validator;
use \MP;
use App\Model\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class Gateway extends Controller
{
  private $mp;

  public function __construct()
  {
    $this->mp = new \MP(config('mercadopago.client'), config('mercadopago.secret'));
    // $this->mp->sandbox_mode(false);
  }
  /**
   * Receives id and topic for storage.
   *
   * @param  int  $id
   * @param  string  $topic
   * @return Response
   */
  public function ipn (Request $request)
  {
    $data = $request->all();
    $data = [
      'topic' => $data['topic']?: 'none',
      'identificator' => $data['id']?: 'none',
    ];

    return Notification::create($data);
  }

  public function showOrder($id)
  {
    return $this->mp->get("/merchant_orders/".$id);
  }

  public function showPayment($id)
  {
    $payment_info = $this->mp->get_payment_info($id);
    return $payment_info;
  }


}
