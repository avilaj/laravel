<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configuration extends Model
{
    //
    protected $table = 'configuration';
    protected $fillable = ['key', 'value', 'owner', 'type'];
    protected $type = null;
    public function __construct() {
    	if ($this->type != null) {
            $conf = DB::table('configuration')->where('type', $this->type)->get();
        } else {
            $conf = DB::table('configuration')->get();
        }
    	for ($i=0; $i < count($conf); $i++) { 
    		# code...
    		$item = $conf[$i];
    		$this->attributes[$item->key] = $item->value;
    	}
    }
    public function cleanedImage ($attribute) {
        if (! empty($attribute)) {
            $attribute = str_replace('uploads/', '', $attribute);
        }
        return $attribute;
    }

    public function find () {}

    public function scopeKey($query, $key) {
    	return $query->where('key', $key);
    }

    public function save(array $options = [])
    {
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }
        foreach ($this->attributes as $key => $value) {
        	# code...
        	DB::table('configuration')
        		->where('key', $key)
        		->update(['value' => $value]);
        }
    	return true;
    }
    public function image ($key) {
        return $this->cleanedImage($this->attributes[$key]);
    }
    public function integer ($key) {
        return intval($this->attributes[$key]);
    }
    public function getBestSellerAttribute() {
        return intval($this->attributes['best_seller']);
    }
    public function setHomeProductsAttribute($val) {
        $products = json_encode($val);
        $this->attributes['home_products'] = $products;
    }
    public function getHomeProductsAttribute() {
        $products = $this->attributes['home_products'];
        try {
            $res = json_decode($products);
        } catch (Exception $e) {
            $res = [];
        }
        return $res;
    }
    public function getHomeSliderAttribute() {
        return intval($this->attributes['home_slider']);
    }

    public function getHomeMiddleBannerImageAttribute () {
        return $this->cleanedImage($this->attributes['home_middle_banner']);
    }

    public function getHomeOcteamImageAttribute () {
        return $this->cleanedImage($this->attributes['home_octeam']);
    }

    public function getHomeOcwarrantyImageAttribute () {
        return $this->cleanedImage($this->attributes['home_ocwarranty']);
    }

    public function getHomeOcstoresImageAttribute () {
        return $this->cleanedImage($this->attributes['home_ocstores']);
    }

    public function getVentasMayoristasImageAttribute () {
        return $this->cleanedImage($this->attributes['ventas_mayoristas']);
    }
}
