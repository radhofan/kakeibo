<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomList extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'visibility',
        'is_ordered',
        'comments_enabled',
    ];

    protected function casts(): array
    {
        return [
            'is_ordered' => 'boolean',
            'comments_enabled' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entries()
    {
        return $this->hasMany(CustomListEntry::class)->orderBy('position');
    }

    public function likes()
    {
        return $this->hasMany(CustomListLike::class);
    }

    public function saves()
    {
        return $this->hasMany(SavedList::class);
    }
}
