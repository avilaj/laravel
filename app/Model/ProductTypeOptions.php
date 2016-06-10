<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class ProductTypeOptions extends Model
{
    use Sluggable;

    protected $table = 'product_type_options';
    protected $fillable = ['name', 'slug'];

    public function sluggable () {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function products() {
    	return $this->hasMany('App\Model\Product');
    }
    public function options() {
        return $this->hasMany('App\Model\ProductTypeOptions');
    }
    // public function category() {
    // 	return $this->belongsTo('App\Model\Category');
    // }

    // public function parent() {
    // 	return $this->belongsTo('App\Model\Product');
    // }

}
