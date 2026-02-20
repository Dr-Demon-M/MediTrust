<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
    ];

    public function specialtyColors()
    {
        return match ($this->name) {
            'Cardiology'    => 'text-danger',
            'Pediatrics'    => 'text-info',
            'Neurology'     => 'text-primary',
            'Orthopedics'   => 'text-warning',
            'Ophthalmology' => 'text-success',
            'Dermatology'   => 'text-secondary',
            default         => 'text-gray',
        };
    }

    // Relationships
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function availabilities()
    {
        return $this->hasManyThrough(
            Availability::class,
            Doctor::class
        );
    }
}
