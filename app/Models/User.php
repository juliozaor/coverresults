<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // Método para obtener el identificador que será almacenado en el claim del JWT.
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Método para devolver un array de claims a agregar al JWT.
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function devices()
    {
        return $this->hasManyThrough(Device::class, Suspect::class);
    }

    public function suspects()
    {
        return $this->hasMany(Suspect::class);
    }

    public function delegates()
    {
        return $this->hasMany(DelegateUser::class, 'user_id');
    }

    public function delegators()
    {
        return $this->hasMany(DelegateUser::class, 'delegate_id');
    }
}
