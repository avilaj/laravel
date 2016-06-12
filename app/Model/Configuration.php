<?php

namespace App\Model;

use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Configuration extends Model
{
    protected $table = 'configuration';

    protected $fillable = [
                        'collection_title',
                        'collection_description',
                        'home_products'
                        ];


    public function __construct()
    {
        $conf = DB::table('configuration')->lists('value', 'key');
        $this->fill($conf);
    }


    public function find ($a)
    {
        return $this->attributes;
    }


    public function save(array $options = array())
    {
        foreach ($this->attributes as $key => $value) {
            DB::table('configuration')
                ->where('key', $key)
                ->update(['value' => $value]);
        }
        return true;
    }


    // public function getHomeProductsAttribute() {
    //     return $this->attributes['home_products'] . "puto";
    // }

    public function setHomeProductsAttribute($value) {
        $this->attributes['home_products'] = str_replace('puto','', $value);
    }

}
