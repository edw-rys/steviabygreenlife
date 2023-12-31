<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model 
{
  use SoftDeletes;
  protected $table = 'country';
  protected $fillable = [
    'id',
    'name',
    'code',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
