<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class Order extends Model
{

  /**
  * SHIPMENT STATUS
  * ================
  * 'FILLING' => '0 - En checkout',
  * 'PROCESANDO'=>'1 - Procesando',
  * 'EMPACANDO'=>'2 - Empacando',
  * 'ENVIADO'=>'3 - Enviado',
  * 'ENTREGADO'=>'4 - Entregado'
  **/

  /**
   *  PAYMENT STATUS
   * ================
   * 'PENDIENTE' => '0 - Pendiente',
   * 'REVISION' => '1 - En revisión',
   * 'RECHAZADO'=>'2 - Rechazado',
   * 'PAGADO'=>'3 - Pagado',
  **/

    protected $PAID_STATE = 'PAGADO';
    protected $FILLING_STATE = null;
    protected $table = 'orders';
    protected $fillable = ['customer_id',
                           'details',
                           'status',
                           'price',
                           'payment_status',
                           'created_at',
                           'city',
                           'state',
                           'postal',
                           'address',
                           'shipping_area_id',
                           'updated_at'];

    public function user() {
        return $this->belongsTo('App\Model\User', 'customer_id');
    }

    public function shippingarea() {
        return $this->belongsTo('App\Model\ShippingArea', 'shipping_area_id');
    }

    public function items() {
      return $this->hasMany('App\Model\OrderItem');
    }

    public function scopeRecent($query) {
      return $query->orderBy('created_at', 'desc');
    }

    public function payments() {
      return $this->hasMany("App\Model\Payment");
    }

    public function isPaid() {
      $total_paid = $this->payments->sum('amount_paid');
      return $this->price <= $total_paid;
    }

    public function markAsPaid() {
      $this->payment_status = $this->PAID_STATE;
      $this->save();
    }

    public function scopeOnCheckout($query) {
      return $query->where('status', $this->FILLING_STATE);
    }


    public function references ()
    {
        return $this->hasMany('App\Model\Reference',
                              'cart_reference',
                              'cart_id',
                              'reference_id');
    }

    public function updatePrice()
    {
      $total = $this->items()->sum(\DB::raw('price*qty'));

      if ($this->shippingarea) {
        $total += $this->shippingarea->price;
      }

      $this->price = $total;
      $this->save();
    }

    public function getItem($reference_id, $size_id) {
      return $this->items()->where('reference_id', $reference_id)
        ->where('size_id', $size_id)->first();
    }

    public function filling() {
      return $this->status == $this->FILLING_STATE;
    }

    public function processShipment() {
      $this->status = 'PROCESANDO';
      $this->save();
    }
    public function markAsFilling() {
      $this->status = $this->FILLING_STATE;
      $this->save();
    }

    static function currentCart() {
      $user = \Auth::user();
      return $user->currentCart();
    }


    public function CreatePayment() {
      $products = $this->items->map(function ($item) {
        return [
          'id' => $item->id,
          'title' => $item->product->title,
          'picture_url' => $item->product->thumbnail,
          'description' => $item->reference->color->name . ' - '. $item->size->label,
          'category_id' => $item->product->category->id,
          'quantity' => $item->qty,
          'unit_price' => $item->price
        ];
      });
      $shipping = $this->shippingarea;

      $products[] = [
        'id' => $shipping->id,
        'title' => 'Envío: '.$shipping->name,
        'quantity' => 1,
        'unit_price' => $shipping->price
      ];

      $mp = new \MP(config('mercadopago.client'), config('mercadopago.secret'));
      $mp->sandbox_mode(FALSE);
      $reference = $mp->create_preference([
        "expires" => false,
        'items'=> $products,
        "auto_return" => "approved",
        "payer_email" => \Auth::user()->email,
        "external_reference" => $this->id,
        "notification_url" => route('cart.ipn'),
        "back_urls" => [
          "success" => route('cart.payment-status'),
          "pending" => route('cart.payment-status'),
          "error" => route('cart.payment-status'),
        ]
      ]);

      return $reference['response']['init_point'];
    }
}
