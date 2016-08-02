<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use OrderableModel;
    use Sluggable;


    protected $table = 'brands';
    protected $fillable = ['name', 'image','order', 'slug'];

    public function sluggable () {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeDefaultSort($query) {
    	return $query->orderBy('order', 'asc');
    }

    public function getOrderField() {
    	return 'order';
    }

    public function products() {
        return $this->hasMany('App\Model\Product');
    }

    public function getUrlAttribute () {
        $url = "/catalogo/{$this->slug}";
        return $url;
    }
}
