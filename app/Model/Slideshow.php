<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use \App\ImageResizable;

    protected $fillable = ['images', 'urls', 'id'];
    public $incrementing = false;

    public function resizable () {
      return [
        'images' => [
          'small' => function ($image) {
            $image->fit(360, 360, function ($constraint) {
              $constraint->upsize();
            });
          },
          'large' => function ($image) {
            $image->resize(2048, 1440, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
            });
          }
        ]
      ];
    }

    public function setImagesForAdminAttribute($image) {
      $this->images = $image;
    }

    public function getImagesForAdminAttribute() {
      return $this->onlyOriginals('images');
    }

    public function getSlidesAttribute() {
      $images = $this->images;
      $links = (array) json_decode($this->urls);
      $assignUrl = function ($image) use ($links) {
        if ($image->original) {
          if (array_key_exists($image->original, $links)) {
            $link = $links[$image->original];
            $image->url = $link;
          }
        }
        return $image;
      };
      if (count($links)) {
        $images = array_map($assignUrl, $images);
      }
      return $images;
    }
}
