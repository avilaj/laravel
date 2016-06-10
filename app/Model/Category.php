<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use OrderableModel;
    use Sluggable;


    protected $table = 'categories';
    protected $fillable = ['name', 'banner','order', 'slug','gallery_id', 'product_id'];
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
        $slug = str_slug($this->name);
        $url = "/productos/{$this->getSlug()}";
        return $url;
    }
    public function getBannerCleanedAttribute() {
        if ( $this->banner && !empty($this->banner) ) {
            return str_replace('uploads/', '', $this->banner);
        }
        return null;
    }
}
