<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpsPosition extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'latitude', 'longitude', 'timestamp'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
