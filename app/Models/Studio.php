<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name', 'external_id'];

    public function anime()
    {
        return $this->belongsToMany(Anime::class);
    }
}
