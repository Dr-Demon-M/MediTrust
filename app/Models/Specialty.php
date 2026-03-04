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
        'subtitle',
        'image',
        'procedures_count',
        'procedures_label',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
        return $this->hasManyThrough(Availability::class, Doctor::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function features()
    {
        return $this->hasMany(SpecialtyFeature::class)->orderBy('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
