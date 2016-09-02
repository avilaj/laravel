<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use \KodiComponents\Support\Upload;

    protected $table = "podcast";
    protected $fillable = ["title", "content", "image"];
    protected $casts = [
      "image" => "image"
    ];

    public function scopeRecent($query) {
      return $query->orderBy('created_at', 'DESC');
    }

    public function getUrlAttribute() {
      return route('podcast.show', $this->id);
    }

    public function getUploadSettings() {
      return [
          'image' => [
              'fit' => [1024, 1024, function ($constraint) {
                  $constraint->upsize();
                  $constraint->aspectRatio();
              }]
          ],
          'image_medium' => [
              'fit' => [540, 540, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
              }]
          ],
          'image_small' => [
              'fit' => [360, 360, function ($constraint) {
                $constraint->upsize();
              }]
          ]
      ];
  }

}
