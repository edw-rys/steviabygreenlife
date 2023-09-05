<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartShopStore extends Model 
{
  // use SoftDeletes;
  protected $table = 'cart_shop_store';
  protected $fillable = [
    'id',
    'shop_cart_id',
    'transaction',
    // end money values
    'request',
    'response',
    'response_id',
    'card_type',
    'last_digits',
    'card_brand',
    'card_brand_code',
    'amount',
    'status_pay',
    'status_pay_code',
    'status_pay_es',
    'message',
    'message_code',
    'currency',
    'document',
    'authorization_code',
    'status', // 'created', 'deleted', 'finished'
    'created_at',
    'updated_at',
    'deleted_at',
  ];

 
  public function products() : HasMany {
    return $this->hasMany(CartShopProductsStore::class, 'cart_shop_store_id');
  }

}
