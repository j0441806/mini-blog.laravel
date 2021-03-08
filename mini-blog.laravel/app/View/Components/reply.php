<?php

namespace App\View\Components;

use Illuminate\View\Component;

class reply extends Component
{
    public $reply;
    public $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($reply, $post)
    {
        $this->reply = $reply;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.reply');
    }
}
