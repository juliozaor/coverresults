<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Suspect extends Authenticatable implements JWTSubject
{
    use HasFactory;
 protected $fillable = [
    'user_id',
    //'device_id',
    'name',
    'lastname',
    'email',
    'password',
    'identification',
    'date_dirth',
    'state_id',
    'city_id',
    'state',
    'city',
    'address',
    'phone',
    'mobile',
    'photo',
];

protected $hidden = [
    'password',
    'remember_token',
];


    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    
    public function getJWTCustomClaims()
    {
        return [];
    }


    
}
