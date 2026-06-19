<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomListEntry extends Model
{
    protected $fillable = ['custom_list_id', 'anime_id', 'position', 'note'];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
