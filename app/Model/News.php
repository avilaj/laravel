<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class News extends Model
{
    use Sluggable;
    use \App\ImageResizable;

    protected $table = 'news';
    protected $fillable = ['slug', 'title', 'thumbnail', 'short_text', 'text', 'gallery', 'pin'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

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

    public function resizable () {
      return [
        'gallery' => [
          'small' => function ($image) {
            $image->fit(360, 360, function ($constraint) {
              $constraint->upsize();
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

    public function setGalleryForAdminAttribute($images) {
      $this->gallery = $images;
    }

    public function getGalleryForAdminAttribute() {
      return $this->onlyOriginals('gallery');
    }

    public function getThumbnailAttribute() {
      $images = $this->gallery;
      if (is_array($images)) {
        return $images[0];
      }
    }

}
