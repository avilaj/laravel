<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'order_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function currentCart() {
      $cart = $this->getCart();
      if ($cart) {
        return $cart;
      }
      $cart = $this->setCart();
      return $cart;
    }

    public function getCart() {
      $user = \Auth::user();
      if ($user->order_id) {
        return $user->orders()->onCheckout()->recent()->first();
      }
      return false;
    }

    public function setCart() {
      $cart_data = [
        'customer_id' => $this->id,
        'status' => 'filling'
      ];
      $cart = Order::create($cart_data);

      $this->order_id = $cart->id;
      $this->save();

      return $cart;
    }

    public function orders() {
        return $this->hasMany('App\Model\Order', 'customer_id');
    }
}
