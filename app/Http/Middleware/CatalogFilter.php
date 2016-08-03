<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CatalogFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      $brand_id = $request->input('brand');
      $category_slug = $request->category_slug;
      $price = $request->input('price');
      $search = $request->input('search');
      $filterCookie = $this->makeCookie($brand_id, $category_slug, $price, $search);

      if ($request->hasCookie('catalog_filter')) {
        $filter = $request->cookie('catalog_filter');
        $diff = array_diff($filter, $filterCookie);
        if (count($diff)) {
          $filter = $filterCookie;
        }
      }

      \Cookie::queue(\Cookie::forever('catalog_filter', $filterCookie));

      $request->filter = $this->makeFilterQuery($brand_id, $category_slug, $price, $search);

      return $next($request);
    }

    public function makeCookie (
      $brand_id = null,
      $category_slug = null,
      $price = null,
      $search = null )
    {
      $filter = compact('brand_id', 'category_slug', 'price', 'search');
      return $filter;
    }

    public function makeFilterQuery (
      $brand_id = null,
      $category_slug = null,
      $price = null,
      $search = null )
    {
      $filter = [
        'brand' => function ($query) use ($brand_id) {
          if ($brand_id) {
            $query->ofBrand($brand_id);
          }
        },
        'category'=> function($query) use ($category_slug) {
          if ($category_slug) {
            $query->ofCategory($category_slug);
          }
        },
        'search' => function ($query) use ($search) {
          if ($search) {
            $query->search($search);
          }
        },
        'price' => function ($query) use ($price) {
          if($price) {
            $price = explode('-', $price);
            if (count($price) === 2) {
              $query->priceBetween($price);
            }
          }
        }
      ];
      return $filter;
    }
}
