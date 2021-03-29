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
        $size = '30px'
    )
    {
        $this->fl = $fl;
        $this->ll = $ll;
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
