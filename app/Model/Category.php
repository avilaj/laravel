<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Baum\Node;

class Category extends node
{
    use OrderableModel;
    use Sluggable;


    protected $table = 'categories';
    protected $fillable = ['name', 'slug'];
    protected $orderColumn = 'name';
    public $timestamps = false;

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

    public function gallery () {
        return $this->belongsTo('App\Model\Gallery');
    }

    public function bestSeller () {
        return $this->belongsTo('App\Model\Product');
    }

    public function products() {
        return $this->hasMany('App\Model\Product');
    }

    public function getUrlAttribute () {
      $url = route('products.list').'?';
      $route = \Route::current()->getName();
      $query = ['category' => $this->id];
      if ('products.list' == $route) {
        // mix the query;
        $request = \Request::all();
        $query = $query + $request;
      }
      $url .= http_build_query($query);

      return $url;
    }

    public function getBannerCleanedAttribute() {
        if ( $this->banner && !empty($this->banner) ) {
            return str_replace('uploads/', '', $this->banner);
        }
        return null;
    }
}
