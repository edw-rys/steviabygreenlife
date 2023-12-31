<?php

namespace App\Models;

use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements AuditableContract
{
    use Auditable;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'last_name', 
        'email', 
        'password',
        // 'username',
        'identification_number', 
        'email_shop', 
        'automatic',
        'country_id',
        'state_id',
        'city_id',
        'created_at', 
        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
        return $this->name . ' '. $this->last_name;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function country() : BelongsTo {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state() : BelongsTo {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city() : BelongsTo {
        return $this->belongsTo(City::class, 'city_id');
    }
}
