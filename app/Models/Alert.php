<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'pulseless',
        'out_of_location',
        'battery_empty',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
