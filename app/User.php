<?php

namespace App;

use Laravel\Scout\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, LogsActivity, Notifiable, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Log changes to all attributes on the model.
     *
     * @var bool
     */
    protected static $logUnguarded = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'social' => 'array',
    ];

    /**
     * A user has one address.
     *
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * A user has one phone number.
     *
     * @return HasOne
     */
    public function phoneNumber(): HasOne
    {
        return $this->hasOne(PhoneNumber::class);
    }

    /**
     * Get the full name of a user.
     *
     * @param $value
     * @return string
     */
    public function getFullNameAttribute($value): string
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    /**
     * Get the full address for a user.
     *
     * @param $value
     * @return string
     */
    public function getFullAddressAttribute($value): string
    {
        return sprintf('%s, %s %s', $this->address->address, $this->address->state, $this->address->zip);
    }
}
