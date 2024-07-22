<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegateUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'delegate_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delegate()
    {
        return $this->belongsTo(User::class, 'delegate_id');
    }
}
