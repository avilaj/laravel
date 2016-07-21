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


    static function currentCart() {
      $user = \Auth::user();
      if ($user) {
        return \Cart::instance($user->id);
      } else {
        return \Cart::instance();
      }
    }


    static function CreatePayment() {
      $cart = self::currentCart();
      $products = [];
      foreach($cart->content() as $item) {
        $products[] = [
          'id' => $item->id,
          'title' => $item->name,
          'description' => $item->options->color . ' - '. $item->options->size,
          'category_id' => 'Zapatos',
          'quantity' => $item->qty,
          'unit_price' => $item->price
        ];
      }

      $mp = new \MP('6671', '6hQurng8uncAK9wdRfe3Mt2XzfZzcPNl');
      $reference = $mp->create_preference([
        "expires" => false,
        'items'=>$products,
        "auto_return" => "approved",
        "external_reference" => "Reference_1234",
        "notification_url" => "https://www.your-site.com/ipn",
        "back_urls" => [
          "success" => "https://www.success.com",
          "failure" => "http://www.failure.com",
          "pending" => "http://www.pending.com"
        ]
      ]);
      return $reference;
    }
}
