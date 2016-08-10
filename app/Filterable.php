<?php
namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
  /**
  * Filter a query result
  */

  public function scopeFilter($query, QueryFilters $filters)
  {
    return $filters->apply($query);
  }
}
