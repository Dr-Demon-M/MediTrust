<?php

namespace App\Models;

use App\Models\Scopes\DoctorScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'patient_name',
        'patient_phone',
        'patient_email',
        'patient_gender',
        'patient_age',
        'specialty_id',
        'service_id',
        'doctor_id',
        'service_price',
        'appointment_datetime',
        'patient_notes',
        'admin_notes',
        'status',
        'user_id',
    ];

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
        'appointment_datetime' => 'datetime',
    ];

    public function scopeFilter(Builder $builder, $Filters)
    {
        return $builder->when($Filters['search'] ?? false, function ($builder, $value) {
            $builder->where('patient_name', 'LIKE', "%{$value}%");
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
