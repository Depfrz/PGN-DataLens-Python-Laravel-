<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $fullWidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fullWidth = false)
    {
        $this->fullWidth = $fullWidth;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
