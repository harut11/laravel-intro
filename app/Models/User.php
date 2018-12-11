<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        self::created(function($model) {
            $model->details()->save(new UserDetails());
        });
        parent::boot();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'owner_id', 'id');
    }

    public function details()
    {
        return $this->hasOne(UserDetails::class, 'id', 'id');
    }

    public function getShortNameAttribute()
    {
        if (!empty($this->details->attributes['first_name']) && !empty($this->details->attributes['last_name'])) {
            $f = $this->details->attributes['first_name'];
            $l = $this->details->attributes['last_name'];
            return substr($f, 0, 1) . '. ' . $l;
        }
        return null;
    }

    public function getFullNameAttribute()
    {
        if (!empty($this->details->attributes['first_name']) && !empty($this->details->attributes['last_name']) && !empty($this->details->attributes['middle_name'])) {
            $f = $this->details->attributes['first_name'];
            $l = $this->details->attributes['last_name'];
            $m = $this->details->attributes['middle_name'];
            return "$f $m $l";
        }
        return null;
    }

    public function getAgeAttribute()
    {
        if (!empty($this->details->attributes['date_of_birth'])) {
            $dob = $this->details->attributes['date_of_birth'];
            $carbon = Carbon::createFromFormat('Y-m-d', $dob);
            return $carbon->diffInYears();
        }
    }
}
