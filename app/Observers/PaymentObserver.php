<?php
namespace App\Observers;

class PaymentObserver {

  public function saved($model) {

    $order = $model->order;

    if ($order->filling()) {
      $order->processShipment();
    }

    if ($order->isPaid()) {
      $order->markAsPaid();
    }

  }

}
