<?php

namespace App\View\Components;

use Illuminate\View\Component;

class submit extends Component
{
    public $action;
    public $submit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.submit');
    }
}
