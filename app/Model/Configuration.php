<?php

  namespace App\Model;

  use Log;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Collection;

  class Configuration extends Model
  {
      protected $table = 'configuration';
      protected $casts = [
        'home_products' => 'array'
      ];
      protected $fillable = [
        'store_title',
        'collection_title',
        'collection_description',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'instagram_url',
        'contact_phone',
        'contact_email',
        'home_products'
      ];


      public function __construct()
      {
          $conf = DB::table('configuration')->lists('value', 'key');
          $this->attributes = $conf;
      }


      public function find ($a)
      {
        return $this->attributes;
      }


      public function save(array $options = array())
      {
        $conf = DB::table('configuration')->lists('value', 'key');
        foreach ($this->attributes as $key => $value) {
          if (array_key_exists($key, $conf)) {
            DB::table('configuration')
            ->where('key', $key)
            ->update(['value' => $value]);
          } else {
            DB::table('configuration')
              ->insert(['key'=> $key, 'value' => $value]);
          }
        }
        return true;
      }

  }
