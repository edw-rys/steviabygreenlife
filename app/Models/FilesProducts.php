<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilesProducts extends Model 
{
  use SoftDeletes;
  protected $table = 'files_products';
  protected $fillable = [
    'id',
    'route_image',
    'product_id',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
  protected $appends = ['url_image'];

  public function getUrlImageAttribute()
  {
    return asset('images/shop/products/' . $this->route_image);
  }
}

