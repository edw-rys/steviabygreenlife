<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartShopProducts extends Model 
{
  use SoftDeletes;
  protected $table = 'cart_shop_products';
  protected $fillable = [
    'id',
    'uuid', // Session in local storage
    'cart_shop_id', 
    'product_id', 
    'route_image',
    'name',
    'description',
    
    'count',
    // Money values
    'price_unit',
    'percentage_tax',
    'total_tax',
    'discount_percentage',
    'discount_value',
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
    'price_unit' => 'float',
    'percentage_tax' => 'float',
    'total_tax' => 'float',
    'discount_percentage' => 'float',
    'discount_value' => 'float',
    'total' => 'float',
  ];

  function product() : BelongsTo {
    return $this->belongsTo(Product::class,'product_id');
  }
}
