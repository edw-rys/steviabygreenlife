<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartShop extends Model 
{
  use SoftDeletes;
  protected $table = 'cart_shop';
  protected $fillable = [
    'id',
    'uuid', // Session in local storage
    'user_id', // default null
    'count_products',
    'ip_address',

    // Money values
    
    'subtotal',
    'discount',
    'subtotal_after_tax',
    'percentage_tax',
    'total_tax',
    
    'total',
    // end money values

    'status', // 'created', 'deleted', 'finished'
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'subtotal' => 'float',
    'discount' => 'float',
    'subtotal_after_tax' => 'float',
    'percentage_tax' => 'float',
    'total_tax' => 'float',
  ];

  function products() : HasMany {
    return $this->hasMany(Product::class,'category_id');
  }
}
