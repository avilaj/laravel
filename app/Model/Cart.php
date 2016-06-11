<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{

    protected $table = 'carts';
    protected $fillable = ['customer_id', 'details'];

    public function user() {
        return $this->belongsTo('App\Model\User');
    }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference',
                              'cart_reference',
                              'cart_id',
                              'reference_id');
    }
}