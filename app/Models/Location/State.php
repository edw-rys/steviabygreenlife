<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model 
{
  use SoftDeletes;
  protected $table = 'state';
  protected $fillable = [
    'id',
    'name',
    'country_id',
    'delivery_cost',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
