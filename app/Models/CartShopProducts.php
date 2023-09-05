<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    'price',
    'price_unit',
    'subtotal_before_discount',
    'discount_percentage',
    'discount_value',
    'total_before_tax', // antes de imps
    'percentage_tax',
    'total_tax',
    'subtotal_after_tax', // después de imps
    'total',
    // end money values
    'status', // 'created', 'deleted', 'pending_pay', 'finished'
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $appends = [ 'price_format', 'total_format', 'url_image'];

  public function getUrlImageAttribute()
  {
    return asset('images/shop/products/' . $this->route_image);
  }
  public function getPriceFormatAttribute()
  {
    return twoStringDecimal($this->price);
  }
  public function getTotalFormatAttribute()
  {
    return twoStringDecimal($this->total);
  }
  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'price'               => 'float',
    'price_unit'          => 'float',
    'percentage_tax'      => 'float',
    'total_tax'           => 'float',
    'subtotal_before_discount'  => 'float',
    'discount_percentage' => 'float',
    'discount_value'      => 'float',
    'subtotal_after_tax'  => 'float',
    'total'               => 'float',
    'total_before_tax'    => 'float'
  ];

  function product() : BelongsTo {
    return $this->belongsTo(Product::class,'product_id');
  }
}
