<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimePerson extends Model
{
    protected $fillable = ['anime_id', 'person_type', 'name', 'role', 'image_url', 'voice_actor'];
}
