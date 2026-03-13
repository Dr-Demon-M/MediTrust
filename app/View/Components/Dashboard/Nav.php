<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Nav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $notifications = auth()->guard('web')->user()->doctor->unreadNotifications()->limit(5)->get();
        $newCount = auth()->guard('web')->user()->doctor->unreadNotifications()->count();
        $chats = auth()->user()->doctor->conversations()->with('patient')->get();

        return view('components.dashboard.nav', compact('notifications', 'newCount', 'chats'));
    }
}
