<?php

namespace App\View\Components;

use Illuminate\View\Component;

class editOrientadorModal extends Component
{
    public $orientador;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orientador)
    {
        //
        $this->orientador = $orientador;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-orientador-modal');
    }
}
