<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Product extends Model
{
    use Sluggable;

    protected $table = 'products';
    protected $fillable = ['title', 'subtitle', 'thumbnail', 'description', 'specs', 'details', 'images', 'tags', 'price', 'link', 'category_id', 'product_id'];

    public function sluggable () {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function colors() {
    	return $this->belongsToMany('App\Model\Color', 'product_colors');
    }

    public function category() {
    	return $this->belongsTo('App\Model\Category');
    }

    public function parent() {
    	return $this->belongsTo('App\Model\Product');
    }

    public function setPriceAttribute($value) {
        if(empty($value)) {
            $value = null;
        }
        $this->attributes['price'] = $value;
    }

    // public function getSpecsAttribute($value)
    public function setSpecsAttribute($value) {
        $cadena = json_encode($value);
        $this->attributes['specs'] = $cadena;
    }
	public function getSpecsAttribute($value) {
        return json_decode($value);
    }
    public function getImagesAttribute($value)
	{
        $images = preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
        if (! is_array($images) )  $images =[];
        return $images;
	}

	public function setImagesAttribute($images)
	{
        $cadena = implode(',', $images);
	    $this->attributes['images'] = $cadena;
	}
    public function getImagesCuratedAttribute() {
        $result = array();
        foreach($this->images as $image) {
            $result[] = str_replace('uploads/', '', $image);
        }
        return $result;
    }
    public function getThumbnailCuratedAttribute() {
        return str_replace('uploads/', '', $this->thumbnail);
    }
    public function getUrlAttribute() {
        $url = "/productos/{$this->category->slug}/{$this->slug}";
        return $url;
    }

    public function setColorsAttribute($colors) {
        $this->colors()->detach();
        if (! $colors) return;
        if (! $this->exists) $this->save();
        $this->colors()->attach($colors);
    }

}
