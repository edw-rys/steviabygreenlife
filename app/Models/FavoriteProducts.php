<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class FavoriteProducts extends Model implements AuditableContract
{
    use Auditable;
    use SoftDeletes;

    protected $table = 'favorite_products';

    protected $fillable = [
        'user_id',
        'product_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
