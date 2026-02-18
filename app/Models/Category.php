<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
        use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function task(){
        return $this->belongsToMany(Task::class, 'category_task');
    }
}
