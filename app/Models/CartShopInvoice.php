<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartShopInvoice extends Model 
{
  use SoftDeletes;
  protected $table = 'cart_shop_invoice';
  protected $fillable = [
    'id',
    'user_id', // default null
    'cart_shop_id',
    'name',
    'last_name',
    // Location
    'country_id',
    'state_id',
    'city_id',
    'address',
    'apartamento',
    // End location

    'phone',
    'email',

    'instruction',
    'business_name',

    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
