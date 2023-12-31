<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model 
{
  use SoftDeletes;
  protected $table = 'category_product';
  protected $fillable = [
    'id',
    'system_name',
    'route_image',
    'name',
    'products_count',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $appends = ['url_image'];

  public function getUrlImageAttribute()
  {
    return asset('images/shop/category/' . $this->route_image);
  }
}
