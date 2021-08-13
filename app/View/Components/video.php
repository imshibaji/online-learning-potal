<?php

namespace App\View\Components;

use Illuminate\View\Component;

class video extends Component
{
    public $width;
    public $height;
    public $poster;
    public $src;
    public $type;
    public $url;
    public $trackerLink;
    public $courseId;
    public $topicId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $width = null,
        $height = null,
        $poster = null,
        $src = null,
        $type = null,
        $url = null,
        $trackerLink = null,
        $courseId = null,
        $topicId = null
    )
    {
        $this->width = $width;
        $this->height = $height;
        $this->poster = $poster;
        $this->src = $src;
        $this->type = $type;
        $this->url = $url;
        $this->trackerLink = $trackerLink;
        $this->courseId = $courseId;
        $this->topicId = $topicId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.video');
    }
}
