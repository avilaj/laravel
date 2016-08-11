<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{

    protected $table = 'order_reference';
    protected $fillable = ['order_id',
                           'size_id',
                           'product_id',
                           'reference_id',
                           'qty',
                           'price',
                           'status',
                           'created_at',
                           'updated_at'];

    public function order() {
        return $this->belongsTo('App\Model\Order')->withPivot('price', 'qty');
    }

    public function size() {
      return $this->belongsTo('App\Model\Size');
    }
    public function product() {
      return $this->belongsTo('App\Model\Product');
    }

    public function reference() {
      return $this->belongsTo('\App\Model\Reference');
    }
}
