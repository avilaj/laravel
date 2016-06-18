<?php

namespace App\Model;
use Log;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Model\Reference;
use App\Model\Color;


class Product extends Model
{
    use Sluggable;

    protected $table = 'products';
    protected $fillable = ['title',
                            'subtitle',
                            'thumbnail',
                            'description',
                            'specs',
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

    public function sizes() {
        return [35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46];
    }

    public function generateReference($color) {
        foreach ($this->sizes() as $value) {
            Reference::create([
                'product_id' => $this->attributes['id'],
                'color' => $color,
                'size' => $value
            ]);
        }
    }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference');
    }

    // public function orders () {
    //     return $this->hasManyThrough('App\Model\OrderItem', 'App\Model\OrderItem');
    // }

    public function setPriceAttribute ($value)
    {
        if(empty($value)) {
            $value = null;
        }
        $this->attributes['price'] = $value;
    }

    public function getUrlAttribute ()
    {
        $url = "/catalogo/{$this->category->slug}/{$this->slug}";
        return $url;
    }
    public function stock() {
        return $this->hasManyThrough('\App\Model\Stock', '\App\Model\Reference');
    }

    public function getQtyAttribute() {
        return $this->stock()->sum('qty');
    }
}
