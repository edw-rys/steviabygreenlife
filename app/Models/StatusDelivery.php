<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusDelivery extends Model
{
    use SoftDeletes;
    protected $table = 'status_delivery';
    protected $fillable = [
        'id',
        'code',
        'title',
        'color',
    ];
}