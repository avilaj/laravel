<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{

    protected $table = 'notifications';
    protected $fillable = ['topic',
                           'identificator',
                           'created_at',
                           'updated_at'];

}
