<?php

namespace App\Models;

use App\Models\Scopes\DoctorScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new DoctorScope);
    }
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function logs()
    {
        return $this->hasMany(AppointmentLog::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeFilter(Builder $builder, $Filters)
    {
        return $builder->when($Filters['search'] ?? false, function ($builder, $value) {
            $builder->where('patient_name', 'LIKE', "%{$value}%");
        });
    }
}
