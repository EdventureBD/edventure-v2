<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LandingLayout extends Component
{
    public function __construct($headerBg='', $metatag='', $metadesc = '')
    {
        $this->headerBg = $headerBg;
        $this->metatag = $metatag;
        $this->metadesc = $metadesc;
    }
    
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.landing')
        ->with('headerBg', $this->headerBg)
        ->with('metatag', $this->metatag)
        ->with('metadesc', $this->metadesc);
    }
}
