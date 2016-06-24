<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{

    protected $table = 'types';
    protected $fillable = ['label'];

    function products() {
    	return $this->hasMany('\App\Model\Product');
    }

    function sizes() {
    	// return $this->hasManyThrough('\App\Model\Size')
    	return $this->belongsToMany('\App\Model\Size', 'types_size', 'type_id', 'size_id');
    }
}
