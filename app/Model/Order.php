<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['customer_id',
                           'details',
                           'status',
                           'price',
                           'created_at',
                           'updated_at'];

    public function user() {
    }

    public function orderItems() {
      return $this->hasMany('App\Model\OrderItem')->withPivot('price', 'qty');
    }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference',
                              'cart_reference',
                              'cart_id',
                              'reference_id');
    }
}
