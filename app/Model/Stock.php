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
      return $this->groupBy('reference_id', 'size_id');
    }

    public function scopeForDisplay($query) {
      return $query->select('reference_id', 'size_id', \DB::raw('sum(qty) as stock'))->group();
    }
}
