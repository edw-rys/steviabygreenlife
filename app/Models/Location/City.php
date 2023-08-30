<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model 
{
  use SoftDeletes;
  protected $table = 'products';
  protected $fillable = [
    'id',
    'name',
    'state_id',
    'country_id',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
