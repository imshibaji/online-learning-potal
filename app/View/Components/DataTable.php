<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    private $fields;
    private $items;

    public function __construct($fields=[], $items=[])
    {
        $this->fields = $fields;
        $this->items = $items;
    }

    public function render()
    {
        return view('components.data-table', [
            'fields' => $this->fields,
            'items' => $this->items
        ]);
    }
}
