<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use \App\ImageResizable;

    protected $table = "podcast";
    protected $fillable = ["title", "content", "image"];

    public function scopeRecent($query) {
      return $query->orderBy('created_at', 'DESC');
    }

    public function getUrlAttribute() {
      return route('podcast.show', $this->id);
    }

    public function resizable () {
      return [
        'image' => [
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

    public function setImageForAdminAttribute($image) {
      $this->image = $image;
    }

    public function getImageForAdminAttribute() {
      return $this->onlyOriginals('image');
    }

}
