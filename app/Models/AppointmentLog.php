<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentLog extends Model
{
    protected $fillable = [
        'appointment_id',
        'action',
        'performed_by',
        'description',
        'service_price',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
