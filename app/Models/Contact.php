<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'category',
        'status',
        'priority',
        'user_id',
        'replied_at',
        'admin_response'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationship with User (if message is from registered user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes for filtering
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessor for sender name (use user name if available, otherwise contact name)
    public function getSenderNameAttribute()
    {
        return $this->user ? $this->user->name : $this->name;
    }

    // Accessor for sender email (use user email if available, otherwise contact email)
    public function getSenderEmailAttribute()
    {
        return $this->user ? $this->user->email : $this->email;
    }

    // Accessor for avatar initials
    public function getAvatarInitialsAttribute()
    {
        $name = $this->sender_name;
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }
}
