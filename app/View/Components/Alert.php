<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $message;

    public function __construct($message, $type='info')
    {
        //
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
//         return <<<'blade'
//     <div class="alert alert-{{$type}} text-center" role="alert">
//         Inspiring Quote:<br> <strong>{{ $message }}</strong>
//     </div>
// blade;

        return view('components.alert', [
                'type' => $this->type, 
                'message' => $this->message
            ]);
    }
}
