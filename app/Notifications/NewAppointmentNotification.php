<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;
    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
        // return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'appointment_created',
            'appointment_id' => $this->appointment->id,
            'patient_name' => $this->appointment->patient_name,
            'date' => $this->appointment->appointment_datetime->toDateTimeString(),
            'message' => 'New appointment booked.',
            'url' => route('appointments.show', $this->appointment->id),
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => 'appointment_created',
            'appointment_id' => $this->appointment->id,
            'patient_name'   => $this->appointment->patient_name,
            'created_at'     => now()->diffForHumans(),
            'message'        => 'New appointment booked.',
            'url' => route('appointments.show', $this->appointment->id),
        ]);
    }
}
