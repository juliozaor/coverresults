<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'serial', 'latitude', 'longitude', 'polygon_id','battery_level','pulseless'. 'fcm_token'];

    public function polygon()
    {
        return $this->belongsTo(Polygon::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Suspect::class);
    }

    public function suspect()
    {
        return $this->hasOne(Suspect::class, 'device_id');
    }
    

    public function gpsPositions()
    {
        return $this->hasMany(GpsPosition::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
