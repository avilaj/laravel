<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Reference extends Model
{

    protected $table = 'references';
    protected $fillable = ['reference', 'product_id', 'color', 'size'];

    public function product ()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }
    public function stock () {
    	return $this->hasMany('App\Model\Stock', 'reference_id');
    }
    public function addStock(int $amount, string $reason) {
    	$stock = new Stock([
                    'reason' => $reason,
                    'qty' => $amount,
                    'product_id' => $this->attributes['id']]);
    	$stock->save();
    }
    public function takeStock(int $amount, string $reason) {
    	$stock = new Stock([
                    'reason' => $reason,
                    'qty' => $amount * -1,
                    'product_id' => $this->attributes['id']]);
    	$stock->save();
    }

    public function getQtyAttribute() {
    	return $this->stock()->sum('qty');
    }
    public function total() {
        return $this->stock()->sum('qty');
    }

}