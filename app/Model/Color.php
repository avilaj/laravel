<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name', 'hex'];
    public $timestamps = false;
    public function products() {
    	return $this->belongsToMany('App\Model\Product', 'product_colors');
    }
}
