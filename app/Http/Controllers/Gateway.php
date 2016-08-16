<?php
namespace App\Http\Controllers;

use Validator;
use \MP;
use App\Model\Notification;
use App\Model\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class Gateway extends Controller
{
  private $mp;

  public function __construct()
  {
    $this->mp = new \MP(config('mercadopago.client'), config('mercadopago.secret'));
    $this->mp->sandbox_mode(FALSE);
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
    $rules = [
      'topic' => 'required',
      'id'=>'required'
    ];

    $this->validate($request, $rules);

    $data = $request->all();
    $data = [
      'topic' => $data['topic'],
      'identificator' => $data['id'],
    ];

    $notification = Notification::create($data);

    $isApproved = function ($item) {
      return $item["status"] == "approved";
    };

    $sumPayment = function ($prev, $item) {
      return $prev + $item["transaction_amount"] * 1;
    };

    if ("payment" == $notification->topic) {
      $payment = $this->mp->get_payment_info($notification->identificator)["response"]["collection"];
      $order = $this->mp->get("/merchant_orders/".$payment['merchant_order_id']);
      if ($order["status"] == 200) {
        $order = $order["response"];
        $amount_requested = $order["total_amount"];

        $payments = $order["payments"];
        $approved_payments = array_filter($payments, $isApproved);
        $amount_paid = array_reduce($approved_payments, $sumPayment, 0);

        if ($amount_paid >= $amount_requested) {
          $payment_data = compact("amount_paid", "amount_requested");
          $payment_data["order_id"] = $order["external_reference"];
          $payment_data["notification_id"] = $notification->id;
          $payment_data["merchant_order"] = $order["id"];

          Payment::create($payment_data);
        }

      }
    }
    return $notification;
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
