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
        'first_name', 'last_name', 'phone', 'bio', 'profile_image', 'preferences',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'preferences' => 'array',
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

    // Get user's full name
    public function getFullNameAttribute()
    {
        // Check if first_name and last_name exist
        if (isset($this->attributes['first_name']) && isset($this->attributes['last_name'])) {
            if ($this->first_name && $this->last_name) {
                return $this->first_name . ' ' . $this->last_name;
            }
        }
        return $this->name;
    }

    // Get avatar initials
    public function getAvatarInitialsAttribute()
    {
        $name = $this->full_name ?? $this->name ?? $this->email;
        $words = explode(' ', $name);
        $initials = '';
        
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        
        return $initials ?: 'AD';
    }

    // Get profile image URL
    public function getProfileImageUrlAttribute()
    {
        // Check if profile_image field exists
        if (isset($this->attributes['profile_image']) && $this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        
        // Generate avatar URL with initials
        $initials = $this->avatar_initials;
        return "https://ui-avatars.com/api/?name={$initials}&background=1D293D&color=ffffff&size=120&rounded=true";
    }

    // Get user preferences with defaults
    public function getPreferencesAttribute($value)
    {
        $defaults = [
            'email_notifications' => true,
            'push_notifications' => true,
            'marketing_updates' => false,
            'theme' => 'light',
            'language' => 'en',
            'two_factor_enabled' => false,
        ];

        // Check if preferences field exists
        if (!isset($this->attributes['preferences'])) {
            return $defaults;
        }

        if ($value) {
            $preferences = is_array($value) ? $value : json_decode($value, true);
            return array_merge($defaults, $preferences ?: []);
        }

        return $defaults;
    }
}
