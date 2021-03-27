<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseList extends Component
{
    private $courses;
    private $mycourses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($courses = [])
    {
        $this->courses = $courses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $datas =  [
            'courses' => $this->courses
        ];
        
        return view('components.course-list', $datas);
    }
}
