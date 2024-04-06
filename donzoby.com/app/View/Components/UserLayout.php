<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class UserLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.user');
    }
}
