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
    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
