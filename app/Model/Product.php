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
    protected $resizes = [
      'large' => [1024, 1024],
      'medium' => [540, 540],
      'small' => [360, 360]
    ];
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

    public function scopeRecent($query) {
      return $query
        ->orderBy('created_at', 'desc')
        ->take(9);
    }

    public function scopePriceBetween($query, $range) {
        return $query->whereBetween('price', $range);
    }

    public function scopeSearch($query, $term) {
        return $query
            ->where('title', 'like', '%'.$term.'%')
            ->orWhere('subtitle', 'like', '%'.$term.'%');
    }

    public function decode_images ($images)  {
      if ('array' === gettype($images)) {
        return $images;
      }
      try {
        return (array) json_decode($images);
      } catch (Exception $e) {
        return [];
      }
    }

    public function get_file_route ($file) {
      $file = basename($file);
      return config('sleeping_owl.imagesUploadDirectory').'/'.$file;
    }

    public function get_filename ($file) {
      return basename($file);
    }

    public function getRemovedImages($images) {
      $prev = array_get($this->attributes, 'images', []);
      $oldImages = $this->decode_images($prev);
      $newImages = $images;

      return array_diff($oldImages, $newImages);
    }

    public function getNewImages($images) {
      $prev = array_get($this->attributes, 'images', []);
      $oldImages = $this->decode_images($prev);
      $newImages = $images;

      return array_diff($newImages, $oldImages);
    }

    public function resize_image($image) {
      $img_route = $this->get_file_route($image);
      $img = \Image::make($img_route);
      $arr = explode('.',$img_route);

      foreach ($this->resizes as $label => $size) {
        $img->resize($size[0], $size[1]);
        $img->save($arr[0].'.'.$label.'.'.$arr[1]);
      }
    }

    public function remove_image($image) {
      $file = $this->get_file_route($image);
      $arr = explode('.', $file);
      try {
        array_map('unlink', glob($arr[0].'.*'));
      } catch (Exception $e) {
        // Don't do anything
      }

    }

    public function setImagesAttribute($images) {
      $images = array_map([$this, 'get_filename'], (array) $images);
      array_map([$this, 'resize_image'], $this->getNewImages($images));
      array_map([$this, 'remove_image'], $this->getRemovedImages($images));

      $this->attributes['images'] = json_encode($images);
    }

    public function getImagesAttribute() {
      $prev = array_get($this->attributes, 'images', []);
      $images = $this->decode_images($prev);
      $images = array_map([$this, 'get_file_route'], $images);

      return $images;
    }

    public function appender($str) {
      return function ($image) use ($str) {
        $arr = explode('.',$image);
        return '/'.$arr[0].'.'.$str.'.'.$arr[1];
      };
    }

    public function getSmallImagesAttribute() {
      $images = $this->decode_images($this->images);
      if (!$this->images) return ['http://placehold.it/360x360'];
      $images = array_map($this->appender('small'), $images);
      return $images;
    }

    public function getMediumImagesAttribute() {
      $images = $this->decode_images($this->images);
      if (!$this->images) return ['http://placehold.it/540x540'];
      $images = array_map($this->appender('medium'), $images);
      return $images;
    }

    public function getLargeImagesAttribute() {
      $images = $this->decode_images($this->images);
      if (!$this->images) return ['http://placehold.it/1024x1024'];
      $images = array_map($this->appender('large'), $images);
      return $images;
    }

    public function getThumbnailAttribute() {
      if (count($this->images) > 0) {
        return $this->small_images[0];
      }
      return 'http://placehold.it/360x360';

    }

    public function availableReferences () {
      return \DB::table('references')
        ->join('stocks', 'references.id', '=', 'stocks.reference_id')
        ->join('sizes', 'sizes.id', '=', 'stocks.size_id')
        ->select('references.id as id', 'sizes.label','references.color_id', \DB::raw('SUM(stocks.qty) as total'))
        ->groupBy('references.id')
        ->where('references.product_id', $this->id)
        ->get();
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
