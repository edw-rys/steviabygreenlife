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
    'name',
    'products_count',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
  function products() : HasMany {
    return $this->hasMany(Product::class,'category_id');
  }
}
