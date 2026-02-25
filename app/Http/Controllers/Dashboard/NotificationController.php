<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->doctor->notifications()->latest()->paginate(5);
        return view('dashboard.notifications.index', compact('notifications'));
    }

    public function markAsRead($notificationId, $appointmentId)
    {
        $notification = Auth::user()
            ->doctor
            ->notifications()
            ->where('id', $notificationId)
            ->firstOrFail();
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        return redirect()->route('appointments.show', $appointmentId);
    }

    public function markAllAsRead()
    {
        Auth::user()->doctor->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index');
    }
}
