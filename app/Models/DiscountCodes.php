<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCodes extends Model 
{
  use SoftDeletes;
  protected $table = 'discount_codes';
  protected $fillable = [
    'id',
    'code',
    'percentage_discount',
    'expired_at',
    'expires',
    'allow_in',
    'attemps',
    'users_used',
    'deleted_at'
  ];

  protected $casts = [
    'users_used'          => 'integer'
  ];
  protected $dates = ['expired_at'];
  function codesUsed() : HasMany {
    return $this->hasMany(CartDiscounts::class, 'cart_shop_id');
  }
}
