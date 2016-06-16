<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{

    protected $table = 'order_reference';
    protected $fillable = ['order_id',
                           'reference_id',
                           'qty',
                           'price',
                           'status',
                           'created_at',
                           'updated_at'];

    public function order() {
        return $this->belongsTo('App\Model\Order');
    }

    public function reference() {
      return $this->belongsTo('\App\Model\Reference');
    }
}