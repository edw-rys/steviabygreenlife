<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Product extends Model implements AuditableContract
{
  use Auditable;
  use SoftDeletes;
  protected $table = 'products';
  protected $fillable = [
    'id',
    'order_index',
    'name',
    'category_id',
    'description',
    'route_image',

    // Money values
    'original_price',
    'price',
    'percentage_tax',
    'total_tax',
    'price_unit',
    'discount_percentage',
    'discount_value',
    // end money values

    'field_1',
    'field_2',
    'field_3',
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
    'price' => 'float',
    'percentage_tax' => 'float',
    'total_tax' => 'float',
    'price_unit' => 'float',
    'discount_percentage' => 'float',
    'discount_value' => 'float',
  ];
  protected $appends = ['url_image', 'price_format', 'tax_div', 'original_price_format'];

  public function getTaxDivAttribute() {
    return $this->percentage_tax / 100;
  }
  public function getUrlImageAttribute()
  {
    return asset('images/shop/products/' . $this->route_image);
  }
  public function getOriginalPriceFormatAttribute()
  {
    return twoStringDecimal($this->original_price);
  }
  
  public function getPriceFormatAttribute()
  {
    return twoStringDecimal($this->price);
  }
  function category(): BelongsTo
  {
    return $this->belongsTo(CategoryProduct::class, 'category_id');
  }

  public function favorites():HasMany {
    return $this->hasMany(FavoriteProducts::class, 'product_id');
  }
}