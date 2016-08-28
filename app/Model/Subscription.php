<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $table = "subscriptions";

  protected $fillable = [
    "name",
    "email"
  ];

}
