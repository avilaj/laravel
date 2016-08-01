<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Reference extends Model
{

    protected $table = 'references';
    protected $fillable = ['reference', 'product_id', 'color_id'];

    public function product ()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function color ()
    {
        return $this->belongsTo('App\Model\Color');
    }

    public function stock ()
    {
    	return $this->hasMany('App\Model\Stock', 'reference_id');
    }

    public function scopeByProduct($query)
    {
        return $query->groupBy(\DB::raw('CONCAT(product_id, "-", color_id)'));
    }

    public function scopeByColor($query)
    {
        return $query->groupBy('color_id');
    }

    public function addStock($size_id, $amount, $reason)
    {
    	$stock = new Stock([
                    'message' => $reason,
                    'qty' => (int) $amount,
                    'size_id' => $size_id,
                    'reference_id' => $this->attributes['id']]);
    	$stock->save();
    }

    public function takeStock($size_id, $amount, $reason)
    {
    	$stock = new Stock([
                    'message' => $reason,
                    'qty' => (int) $amount * -1,
                    'size_id' => $size_id,
                    'reference_id' => $this->attributes['id']]);
    	$stock->save();
    }

    public function getQtyAttribute()
    {
    	return $this->stock()->sum('qty');
    }

    public function total()
    {
        return $this->stock()->sum('qty');
    }
}
