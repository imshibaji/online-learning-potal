<?php

namespace App\View\Components;

use Illuminate\View\Component;

class discussions extends Component
{
    public $comments;
    public $topic;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($topic, $comments = [])
    {
        $this->comments = $comments;
        $this->topic = $topic;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.discussions');
    }
}
