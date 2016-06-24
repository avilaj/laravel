<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class ReferenceSize extends Model
{

    protected $table = 'reference_size';
    protected $fillable = ['size_id',
                           'reference_id',
                           'created_at',
                           'updated_at'];

    public function size() {
        return $this->belongsTo('App\Model\Size');
    }

    public function reference() {
      return $this->belongsTo('\App\Model\Reference');
    }
}