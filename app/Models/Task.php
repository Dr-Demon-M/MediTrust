<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_task');
    }

        public function favbyuser(){
        return $this->belongsToMany(User::class, 'favorites');
    }
}
