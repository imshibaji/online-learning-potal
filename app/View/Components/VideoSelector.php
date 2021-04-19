<?php

namespace App\View\Components;

use App\Models\Video;
use Illuminate\View\Component;

class VideoSelector extends Component
{
    public $videos;
    public $vid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $vid=null
    )
    {
        // $this->videos = Video::where('videoable_type', null)->get();
        $this->videos = Video::all();
        $this->vid = $vid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.video-selector');
    }
}
