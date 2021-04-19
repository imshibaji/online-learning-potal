<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $fl, $ll, $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $fl = 'G',
        $ll = 'U',
        $size = '35px'
    )
    {
        $this->fl = substr($fl,0,1);
        $this->ll = substr($ll,0,1);
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
