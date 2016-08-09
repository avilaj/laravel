<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class News extends Model
{
    use Sluggable;

    protected $table = 'news';
    protected $fillable = ['slug', 'title', 'thumbnail', 'short_text', 'text', 'gallery', 'pin'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    protected $sizes = [
      'large' => [1024, 1024],
      'medium' => [540, 540],
      'small' => [360, 360]
    ];

    public function sluggable () {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeFeatured($query) {
      return $query->where('pin', true);
    }

    public function scopeRecent($query) {
      return $query->orderBy('created_at', 'DESC');
    }

    public function getUrlAttribute() {
      return route('news.show', $this->id);
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
      $prev = array_get($this->attributes, 'gallery', []);
      $oldImages = $this->decode_images($prev);
      $newImages = $images;

      return array_diff($oldImages, $newImages);
    }

    public function getNewImages($images) {
      $prev = array_get($this->attributes, 'gallery', []);
      $oldImages = $this->decode_images($prev);
      $newImages = $images;

      return array_diff($newImages, $oldImages);
    }

    public function resize_image($image) {
      $img_route = $this->get_file_route($image);
      $img = \Image::make($img_route);
      $arr = explode('.',$img_route);

      foreach ($this->sizes as $label => $size) {
        $img->fit($size[0], $size[1], function ($intervention) {
          $intervention->upsize();
        });
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
      $this->attributes['gallery'] = json_encode($images);
    }
    public function getImagesAttribute() {
      $images = $this->decode_images($this->attributes['gallery']);
      if($images) {
        $images = array_map([$this,'get_file_route'], $images);
      }
      return $images;
    }

    public function appender($str) {
      return function ($image) use ($str) {
        $arr = explode('.',$image);
        return '/'.$arr[0].'.'.$str.'.'.$arr[1];
      };
    }

    public function thumbnail($size = 'small') {
      $images = $this->gallery($size);
      if (count($images) > 0) {
        return $images[0];
      }
      return 'http://placehold.it/'.$this->sizes[$size][0].'x'.$this->sizes[$size][1];
    }

    public function getThumbnailAttribute() {
      return $this->thumbnail('small');
    }

    public function gallery($size = 'small') {
      $images = $this->decode_images($this->attributes['gallery']);
      if (!$images) return [];
        $images = array_map([$this,'get_file_route'], $images);
        $images = array_map($this->appender($size), $images);

        return $images;

    }

    public function getGalleryAttribute() {
      return $this->gallery('small');
    }


}
