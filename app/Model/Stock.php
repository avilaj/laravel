<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{

    protected $table = 'stocks';
    protected $fillable = ['reference_id', 'size_id', 'qty', 'message'];

    public function reference ()
    {
        return $this->belongsTo('App\Model\Reference', 'reference_id');
    }

    public function size ()
    {
        return $this->belongsTo('App\Model\Size', 'size_id');
    }

    public function scopeGroup($query) {
      return $this->groupBy(\DB::raw('CONCAT(reference_id, "-", size_id)'));
    }

    public function scopeForDisplay($query) {
      return $query->group()
      ->join('sizes', 'stocks.size_id', '=', 'sizes.id')
      ->select('reference_id', 'sizes.label','size_id', \DB::raw('sum(qty) as stock'));
    }
}
