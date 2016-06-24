<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Size extends Model
{

    protected $table = 'sizes';
    protected $fillable = ['label'];

    public function types () {
    	return $this->belongsToMany('App\Model\Type', 'types_size', 'size_id', 'type_id');
    }

    public function references () {
    	return $this->hasMany('\App\Model\Reference');
    }
    public function products () {
    	return $this->hasManyThrough('\App\Model\Product','\App\Model\Reference');
    }
}
