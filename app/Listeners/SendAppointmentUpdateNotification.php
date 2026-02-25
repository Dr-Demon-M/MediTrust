<?php

namespace App\Listeners;

use App\Events\AppointmentUpdated;
use App\Notifications\UpdateAppointmentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAppointmentUpdateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentUpdated $event): void
    {
        $appointment = $event->appointment;
        $doctor = $appointment->doctor;
        $doctor->notify(new UpdateAppointmentNotification($appointment));
    }
}