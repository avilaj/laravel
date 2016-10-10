<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingArea extends Model
{
    protected $table = 'shipping_areas';

    protected $fillable = [
      'name',
      'price',
    ];

    public function orders() {
      return $this->hasMany('App\Model\Order', 'shipping_area_id');
    }

}
