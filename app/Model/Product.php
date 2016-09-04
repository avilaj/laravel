<?php

namespace App\Model;
use Log;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Model\Reference;
use App\Model\Color;
use App\Filterable;

class Product extends Model
{
    use Sluggable;
    use Filterable;
    use \App\ImageResizable;

    protected $table = 'products';
    protected $fillable = ['title',
                            'subtitle',
                            'thumbnail',
                            'description',
                            'variations',
                            'type_id',
                            'brand_id',
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

    public function brand () {
        return $this->belongsTo('\App\Model\Brand');
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

    public function scopeOfBrand($query, $brand_id) {
        return $query->where('brand_id', $brand_id);
    }

    public function scopeOfCategory($query, $id) {
      return $query->where('category_id', $id);
    }

    public function scopeRecent($query) {
      return $query
        ->orderBy('created_at', 'desc');
    }

    public function scopePriceBetween($query, $range) {
        return $query->whereBetween('price', $range);
    }

    public function scopeSearch($query, $term) {
        return $query
            ->where('title', 'like', '%'.$term.'%')
            ->orWhere('subtitle', 'like', '%'.$term.'%');
    }

    public function resizable () {
      return [
        'images' => [
          'small' => function ($image) {
            $image->fit(360, 360, function ($constraint) {
              $constraint->upsize();
            });
          },
          'medium' => function ($image) {
            $image->resize(540, 540, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
            });
          },
          'large' => function ($image) {
            $image->resize(1288, 740, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
            });
          }
        ]
      ];
    }

    public function setImagesForAdminAttribute($images) {
      $this->images = $images;
    }

    public function getImagesForAdminAttribute() {
      return $this->onlyOriginals('images');
    }

    public function getThumbnailAttribute() {
      $images = $this->images;
      if (is_array($images)) {
        return $images[0];
      }
    }

    public function availableReferences () {
      return $this->stock()->forDisplay();
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
        return route('products.show', $this->id);
    }

    public function getQtyAttribute() {
        return $this->stock()->sum('qty');
    }

    public function relatedProducts($amount = 5) {
      $category = Product::where('category_id', $this->category_id)
        ->take($amount)->get();
      if ($category->count() < $amount ) {
        $differents = Product::whereNotIn('id', $category->pluck('id'))
        ->take($amount)->get();
        $category->merge($differents);
      }

      return $category->take($amount);
    }
}
