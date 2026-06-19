<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomListLike extends Model
{
    protected $fillable = ['user_id', 'custom_list_id'];
}
