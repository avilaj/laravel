<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Reference extends Model
{

    protected $table = 'references';
    protected $fillable = ['reference', 'product_id', 'specs'];

    public function product ()
    {
        return $this->belongsTo('App\Model\Product');
    }

}