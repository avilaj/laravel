<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{

    protected $table = 'stocks';
    protected $fillable = ['reference_id', 'size_id', 'qty', 'message'];

    public function reference ()
    {
        return $this->belongsTo('App\Model\Reference', 'reference_id');
    }
}