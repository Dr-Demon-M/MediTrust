<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class specialtyfeature extends Model
{
    protected $fillable = [
        'specialty_id',
        'title',
        'description',
        'order',
    ];
}
