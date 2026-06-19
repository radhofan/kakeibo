<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_user_id',
        'reportable_type',
        'reportable_id',
        'reason',
        'details',
        'status',
        'assigned_moderator_id',
        'resolution_note',
        'resolved_at',
    ];
}
