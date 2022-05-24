<?php

namespace App\View\Components;

use App\Models\Orientador;
use Illuminate\View\Component;

class createAlunoModal extends Component
{

    public $orientadores;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orientadores)
    {
        //
        $this->orientadores = $orientadores;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.create-aluno-modal');
    }
}
