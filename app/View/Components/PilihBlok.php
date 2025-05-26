<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PilihBlok extends Component
{
    public $bloks;

    public function __construct($bloks)
    {
        $this->bloks = $bloks;
    }

    public function render()
    {
        return view('components.PilihBlok');
    }
}
