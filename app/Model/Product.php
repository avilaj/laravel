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
                            'variations',
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

    public function references ()
    {
        return $this->hasMany('\App\Model\Reference');
    }

    public function stock() {
        return $this->hasManyThrough('\App\Model\Stock', '\App\Model\Reference');
    }

    public function colors () {
        return $this->belongsToMany('\App\Model\Color', 'references', 'product_id', 'color_id');
    }

    public function setVariationsAttribute($colors) {
      $news = array_diff($colors, $this->variations->pluck('id')->toArray());
      if (count($news) > 0) {
        foreach ($colors as $colorId) {
          $this->generateReference($colorId);
        }
      }
    }

    public function getVariationsAttribute() {
        return $this->colors->unique('name');
    }

    public function generateReference($colorId) {
        $sizes = $this->type->sizes;
        $existing = $this->references()->where('color_id', $colorId)->pluck('reference')->toArray();
        foreach ($sizes as $size) {
            $reference = 'MK-'.$this->id.'-'.$colorId;
            if (! in_array($reference, $existing)) {
              $this->references()->create([
                'reference' => $reference,
                'color_id' => $colorId,
                'size_id' => $size->id
              ]);
            }
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
