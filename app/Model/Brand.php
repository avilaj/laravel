<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use OrderableModel;
    use Sluggable;
    use \App\ImageResizable;


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
      $url = route('products.list').'?';
      $route = \Route::current()->getName();
      $query = ['brand' => $this->id];
      if ('products.list' == $route) {
        // mix the query;
        $request = \Request::all();
        $query = $query + $request;
      }
      $url .= http_build_query($query);
      return $url;
    }

    public function resizable () {
      return [
        'image' => [
          'small' => function ($image) {
            $image->fit(360, 360, function ($constraint) {
              $constraint->upsize();
            });
          },
          'large' => function ($image) {
            $image->fit(1024, 1024, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
            });
          }
        ]
      ];
    }

    public function setImageForAdminAttribute($image) {
      $this->image = $image;
    }

    public function getImageForAdminAttribute() {
      return $this->onlyOriginals('image');
    }
}
