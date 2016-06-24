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
                            'type_id',
                            'specs',
                            'images',
                            'price',
                            'category_id'];

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

    public function type () {
        return $this->belongsTo('\App\Model\Type');
    }

    // public function sizes () {
    //     return $this->hasManyThrough('\App\Model\Size', '\App\Model\Type');
    // }

    public function references ()
    {
        return $this->hasMany('App\Model\Reference');
    }

    public function stock() {
        return $this->hasManyThrough('\App\Model\Stock', '\App\Model\Reference');
    }

    public function generateReference($colorId) {
        // Log::info($this->type);
        $sizes = $this->type->sizes;
        // Log::info($sizes);
        foreach ($sizes as $size) {
            $this->references()->create([
                'reference' => 'MK-'.$this->id.'-'.$colorId,
                'color_id' => $colorId,
                'size_id' => $size->id
            ]);
        }
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

    public function getQtyAttribute() {
        return $this->stock()->sum('qty');
    }
}
