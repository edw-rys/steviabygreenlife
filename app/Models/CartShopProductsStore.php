<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartShopProductsStore extends Model 
{
  // use SoftDeletes;
  protected $table = 'cart_shop_products_store';
  protected $fillable = [
    'id',
    'product_shop_id',
    'cart_shop_store_id',
    'shop_cart_id',
    'transaction',
    'count',
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
    'subtotal'              => 'float',
    'discount'              => 'float',
    'subtotal_after_tax'    => 'float',
    'percentage_tax'        => 'float',
    'total_tax'             => 'float',
    'subtotal_before_discount' => 'float',
    'total_before_tax'      => 'float',
    'total_items_products'  => 'integer',
    'delivery_cost'         => 'float',
    'total_more_delivery'   => 'float',
  ];


  protected $appends = [ 'total_format', 'delivery_cost_format', 'total_more_delivery_format'];

  public function getTotalFormatAttribute()
  {
    return twoStringDecimal($this->total);
  }
  

  public function getDeliveryCostFormatAttribute()
  {
    return twoStringDecimal($this->delivery_cost);
  }

  public function getTotalMoreDeliveryFormatAttribute()
  {
    return twoStringDecimal($this->total_more_delivery);
  }
  public function products() : HasMany {
    return $this->hasMany(CartShopProducts::class, 'cart_shop_id');
  }

  public function billing() : BelongsTo{
    return $this->belongsTo(CartShopInvoice::class, 'id','cart_shop_id');
  }
}
