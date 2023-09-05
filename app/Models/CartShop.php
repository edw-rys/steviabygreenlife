<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    'total_items_products',

    // Money values
    
    'subtotal',
    'subtotal_before_discount',
    'discount',
    'total_before_tax',
    'percentage_tax',
    'total_tax',
    'subtotal_after_tax',
    'total',
    'delivery_cost',
    'total_more_delivery',
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


  protected $appends = [ 'total_format', 'delivery_cost_format', 'total_more_delivery_format', 'total_more_delivery_int'];

  public function getTotalFormatAttribute()
  {
    return twoStringDecimal($this->total);
  }
  public function getTotalMoreDeliveryIntAttribute() {
    return round((+twoStringDecimal($this->total)) * 100, 0);
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
