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
        return $this->belongsTo('App\Model\User', 'customer_id');
    }

    public function items() {
      return $this->hasMany('App\Model\OrderItem');
    }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference',
                              'cart_reference',
                              'cart_id',
                              'reference_id');
    }

    public function updatePrice() {
      $total = $this->items()->sum(\DB::raw('price*qty'));
      $this->price = $total;
      $this->save();
    }
}