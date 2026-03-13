<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.Doctor.{id}', function ($user, $id) {
    return $user->doctor && (int) $user->doctor->id === (int) $id;
});

