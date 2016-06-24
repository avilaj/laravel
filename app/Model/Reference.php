<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Reference extends Model
{

    protected $table = 'references';
    protected $fillable = ['reference', 'product_id', 'color_id', 'size_id'];

    public function product ()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function size () {
        return $this->belongsTo('\App\Model\Size');
    }

    public function stock () {
    	return $this->hasMany('App\Model\Stock', 'reference_id');
    }

    public function scopeByProduct($query) {
        return $query->groupBy(\DB::raw('CONCAT(product_id, "-", color_id)'));
    }

    public function scopeByColor($query) {
        return $query->groupBy('color_id');
    }

    public function addStock(int $amount, string $reason) {
    	$stock = new Stock([
                    'message' => $reason,
                    'qty' => $amount,
                    'reference_id' => $this->attributes['id']]);
    	$stock->save();
    }
    public function takeStock(int $amount, string $reason) {
    	$stock = new Stock([
                    'message' => $reason,
                    'qty' => $amount * -1,
                    'reference_id' => $this->attributes['id']]);
    	$stock->save();
    }

    public function getQtyAttribute() {
    	return $this->stock()->sum('qty');
    }
    public function total() {
        return $this->stock()->sum('qty');
    }

}