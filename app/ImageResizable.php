<?php
namespace App;
use \Image;

trait ImageResizable {
  /**
  * Adjusts the encode quality
  **/
  private $quality = 80;

  public function getAttributeValue ($key) {
    $value = parent::getAttributeValue($key);

    if (array_key_exists($key, $this->resizable())) {

      if (empty($value)) return $value;

      $value = $this->retrievePhotoFieldValue($key, $value);
    }

    return $value;
  }

  public function setAttribute ($key, $value) {
    $image_fields = $this->resizable();
    if (array_key_exists($key, $image_fields) && $value) {
      $transformations = $image_fields[$key];
      $resize = function ($filename) use ($transformations) {
        return $this->resize($filename, $transformations);
      };

      if (empty($value)) {
        return parent::setAttribute($key, $value);
      }

      if (is_string($value)) {
        // it's just one image, sync filesistem with current status
        $value = json_encode($resize($value));
      } else if (is_array($value)) {
        // it's a gallery, parse and sync each image with fs
        $value = json_encode(array_map($resize, $value));
      }
    }
    return parent::setAttribute($key, $value);
  }

  public function onlyOriginals($key) {
    $value = $this->$key;

    if (is_string($value)) {
      $value = json_decode($value);
    }

    if (is_array($value)) {
      $getOriginalFilename = function ($img) {
        return $img->original;
      };
      $value = array_map($getOriginalFilename, $value);
    } else if (!empty($value)) {
      $value = $value->original;
    }

    return $value;

  }

  public function retrievePhotoFieldValue($key, $value) {
    return json_decode($value);
  }

  // applies a set of transformations to an image and saves them to fs;
  public function resize ($image, $transformations) {
    $img = Image::make($image);
    $img->backup();
    $filename_base = $img->dirname.'/'.$img->filename.'_';
    $filename_extension = '.'.$img->extension;
    $data = ['original' => $image];
    $transform = function($modify, $name, $img)
    use (&$data, $filename_base, $filename_extension) {
      $img->reset();
      $modify($img);
      $mod_file = $filename_base.$name.$filename_extension;
      $img->encode('jpg', $this->quality );
      $img->save($mod_file);
      $img->reset();
      $data[$name] = $mod_file;
    };

    array_walk($transformations, $transform, $img);

    return $data;
  }
  public function deleteMissingImages($key, $value) {}
  public function resizeNewOnes($key, $value) {}
}
