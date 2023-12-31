<?php

namespace App\Models;

use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
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
    'discount_code',
    'subtotal_before_discount_code',
    'total_before_tax',
    'percentage_tax',
    'total_tax',
    'subtotal_after_tax',
    'total',
    'delivery_cost',
    'total_more_delivery',
    // end money values
    'status_delivery',
    'status_delivery_lang',
    'status_delivery_color',

    'number_order',

    'status', // 'created', 'deleted', 'finished'
    'created_at',
    'updated_at',
    'bought_at',
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
    'subtotal_before_discount_code'=> 'float',
    'total_before_tax'      => 'float',
    'total_items_products'  => 'integer',
    'delivery_cost'         => 'float',
    'total_more_delivery'   => 'float',
    'discount_code'         => 'float',
    'number_order'          => 'integer'
  ];

  protected $dates = ['bought_at'];

  protected $appends = [ 'total_format', 'delivery_cost_format', 'total_more_delivery_format', 'total_more_delivery_int', 'created_at_format', 'bought_at_format', 'numero_pedido', 'discount_code_format', 'subtotal_before_discount_code_format'];

  public function getNumeroPedidoAttribute() {
    if($this->number_order == null){
      return '';
    }
    return str_pad($this->number_order, 9, "0", STR_PAD_LEFT);
  }
  

  public function getBoughtAtFormatAttribute(){
    return $this->bought_at != null ? $this->bought_at->format('d/m/Y'): '';
  }

  public function getCreatedAtFormatAttribute(){
    return $this->created_at != null ? $this->created_at->format('d/m/Y'): '';
  }

  
  public function getSubtotalBeforeDiscountCodeFormatAttribute()
  {
    return twoStringDecimal($this->subtotal_before_discount_code);
  }
  
  public function getDiscountCodeFormatAttribute()
  {
    return twoStringDecimal($this->discount_code);
  }
  public function getTotalFormatAttribute()
  {
    return twoStringDecimal($this->total);
  }
  public function getTotalMoreDeliveryIntAttribute() {
    return round((+twoStringDecimal($this->total_more_delivery)) * 100, 0);
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
  public function files() {
    return $this->hasMany(FileUploadTransfer::class, 'cart_shop_id');
  }

  public function discounts() {
    return $this->belongsToMany(DiscountCodes::class, 'cart_discounts', 'cart_shop_id', 'discount_id')->latest();
  }

  public function discountCart()
  {
      return $this->hasOneThrough(DiscountCodes::class, CartDiscounts::class, 'cart_shop_id', 'id', 'id', 'discount_id')->withTrashed();
  }
  function discountReference()  {
    return $this->hasOne(CartDiscounts::class, 'cart_shop_id');
  }
}
