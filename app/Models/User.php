<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'display_name',
        'username',
        'email',
        'password',
        'avatar_url',
        'banner_url',
        'bio',
        'location',
        'preferred_title_language',
        'profile_visibility',
        'library_visibility',
        'activity_visibility',
        'notification_preferences',
        'role',
        'account_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'notification_preferences' => 'array',
        ];
    }

    public function libraryEntries()
    {
        return $this->hasMany(LibraryEntry::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function customLists()
    {
        return $this->hasMany(CustomList::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'followed_user_id')
            ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'follower_user_id')
            ->withTimestamps();
    }

    public function getPublicNameAttribute(): string
    {
        return $this->display_name ?: $this->name;
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }
}
