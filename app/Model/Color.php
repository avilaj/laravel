<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Color extends Model
{

    protected $table = 'colors';
    public $timestamps = false;
    protected $fillable = ['name',
                           'hex',
                           'created_at',
                           'updated_at'];

    public function products() {
        // return $this->hasManyThrough('\App\Model\Product', '\App\Model\Reference');
        return $this->belongsToMany('\App\Model\Product', 'references', 'color_id', 'product_id');
    }
    public function references () {
        return $this->hasMany('App\Model\Reference');
    }

}
