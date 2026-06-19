<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModerationAction extends Model
{
    protected $fillable = [
        'moderator_user_id',
        'target_user_id',
        'target_type',
        'target_id',
        'action_type',
        'reason',
        'metadata',
    ];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }
}
