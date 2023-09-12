<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDiscounts extends Model 
{
  use SoftDeletes;
  protected $table = 'cart_discounts';
  protected $fillable = [
    'id',
    'code',
    'cart_shop_id',
    'discount_id',
    'user_id',
    'deleted_at',
  ];

  public function cartShop() : BelongsTo {
    return $this->belongsTo(CartShop::class, 'cart_shop_id');
  }
  public function discount() : BelongsTo {
    return $this->belongsTo(DiscountCodes::class, 'discount_id');
  }
}
