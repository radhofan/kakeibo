<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'activity_type', 'subject_type', 'subject_id', 'metadata', 'visibility'];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
