<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use OrderableModel;
    use Sluggable;


    protected $table = 'brands';
    protected $fillable = ['name', 'image','order', 'slug'];
    protected $sizes = [
      'small' => [150, 150]
    ];

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
        $slug = \Request::route()->parameter('category_slug');
        return route('catalog', ['category_slug'=>$slug]).'?brand='.$this->id;
    }

    public function get_file_route ($file) {
      $file = basename($file);
      return config('sleeping_owl.imagesUploadDirectory').'/'.$file;
    }

    public function get_filename ($file) {
      return basename($file);
    }

    public function resize_image($image) {
      $img_route = $this->get_file_route($image);
      $img = \Image::make($img_route);
      $arr = explode('.',$img_route);

      foreach ($this->sizes as $label => $size) {
        $img->fit($size[0], $size[1]);
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

    public function setImageAttribute($image) {
      if ($image && $image != "") {
        $image = $this->get_filename($image);
        if ($image != $this->attributes['image']) {
          $this->resize_image($image);
        }
      } else {
        if (isset($this->attributes['image'])) {
          $this->remove_image($this->attributes['image']);
        }
      }
      $this->attributes['image'] = $image;
    }

    public function appender ($str) {
      return function ($image) use ($str) {
        $arr = explode('.',$image);
        return '/'.$arr[0].'.'.$str.'.'.$arr[1];
      };
    }

    public function image ($size = 'small') {
      $res = join('x', $this->sizes[$size]);
      if (!$this->attributes['image']) return 'http://placehold.it/'.$res;
      $appended = $this->appender($size);
      return $appended($this->get_file_route($this->attributes['image']));
    }

    public function getImageAttribute () {
        return $this->image('small');
    }
}
