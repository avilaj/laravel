<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $table = 'persons';
    protected $fillable = ['name', 'activity','bio', 'facebook', 'twitter','instagram','youtube', 'gallery_id'];

    public function gallery() {
    	return $this->belongsTo('App\Model\Gallery');
    }
}
