<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;

class ClientEventsViewsSystem extends Model 
{
  use SoftDeletes;
  protected $table = 'client_events_views_system';
  protected $fillable = [
    'id',
    'action',
    'context',
    'user_id',
    'ip_address',
    'browser',
    'operative_system',
    'user_agent',
    'canal',
    'no_accesible',
    'resource_id',
    'time_action',
    'start_date',
    'end_date',
    'authorization',
    'field_1',
    'field_2',
    'field_3',
    'created_at',
    'updated_at',
    'deleted_at',

    'city',
    'region_code',
    'region',
    'region_name',
    'country_code',
    'country_name',
    'continent_code',
    'continent_name',
    'latitude',
    'longitude',
    'timezone',
    'location_accuracy_radius',
  ];
}
