<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'suspect_id',
        'device_id',
        'date',
        'locations'
    ];

    protected $casts = [
        'locations' => 'array',
        'date' => 'date'
    ];

    public function suspect()
    {
        return $this->belongsTo(Suspect::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
