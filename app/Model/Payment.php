<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $table = "payments";

  protected $fillable = [
    "amount_requested",
    "amount_paid",
    "order_id",
    "notification_id",
    "merchant_order"
  ];

  public function order() {
    return $this->belongsTo("App\Model\Order");
  }

  public function notification() {
    return $this->belongsTo("App\Model\Order");
  }

}
