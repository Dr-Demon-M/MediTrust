<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRoleProfile
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
    public function handle(Registered $event)
    {
        // $user = $event->user;

        // if ($user->role === 'doctor') {
        //     $user->doctor()->create([]);
        // }

        // if ($user->role === 'patient') {
        //     $user->patient()->create([]);
        // }
    }
}
