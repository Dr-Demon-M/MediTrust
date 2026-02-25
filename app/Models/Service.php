<?php

namespace App\Models;

use App\Models\Scopes\DoctorScope;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'specialty_id',
        'duration',
        'price',
        'featured_service',
    ];


    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
