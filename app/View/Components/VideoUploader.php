<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VideoUploader extends Component
{
    public $name;
    public $src;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = 'video',
        $src = null
    )
    {
        $this->name = $name;
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.video-uploader');
    }
}
