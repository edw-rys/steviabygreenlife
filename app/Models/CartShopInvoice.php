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

class CartShopInvoice extends Model 
{
  use SoftDeletes;
  protected $table = 'cart_shop_invoice';
  protected $fillable = [
    'id',
    'uuid',
    'identification_number',
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
    'aditional_info',

    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function city() : BelongsTo {
    return $this->belongsTo(City::class, 'city_id');
  }
  public function country() : BelongsTo{
    return $this->belongsTo(Country::class, 'country_id');
  }

  public function state() : BelongsTo{
    return $this->belongsTo(State::class, 'state_id');
  }
}
