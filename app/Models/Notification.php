<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['device_id', 'title', 'description', 'notification_time', 'read'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
