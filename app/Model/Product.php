<?php

namespace App\Model;
use Log;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Product extends Model
{
    use Sluggable;

    protected $table = 'products';
    protected $fillable = ['title',
                            'subtitle',
                            'thumbnail',
                            'description',
                            'specs',
                            'details',
                            'images',
                            'price',
                            'category_id'];
    public function find($algo) {
        Log::info("find");
        parent::find($algo);
    }
    public function sluggable () {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category ()
    {
    	return $this->belongsTo('App\Model\Category');
    }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference');
    }

    public function setPriceAttribute ($value)
    {
        if(empty($value)) {
            $value = null;
        }
        $this->attributes['price'] = $value;
    }

    public function getUrlAttribute ()
    {
        $url = "/productos/{$this->category->slug}/{$this->slug}";
        return $url;
    }

}
