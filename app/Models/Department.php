<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'short_description',
        'description',
        'featured',
    ];
}
