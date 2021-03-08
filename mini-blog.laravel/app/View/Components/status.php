<?php

namespace App\View\Components;

use Illuminate\View\Component;

class status extends Component
{
    public $status;
    public $link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status, $link)
    {
        $this->status = $status;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.status');
    }
}
