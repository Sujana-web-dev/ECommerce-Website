<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'user_type', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->user_type === 'admin';
    }

    // Cart relationship
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Orders relationship
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
