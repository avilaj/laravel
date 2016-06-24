<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Color extends Model
{

    protected $table = 'colors';
    protected $fillable = ['name',
                           'hex',
                           'created_at',
                           'updated_at'];

    public function products() {
        return $this->hasManyThrough('\App\Model\Product', '\App\Model\Reference');
    }

    public function references () {
        return $this->hasMany('App\Model\Reference');
    }

}