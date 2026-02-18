<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Side extends Component
{

    public $active;
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->active = request()->route()->getName();
        $this->items = config('side');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.side');
    }
}
