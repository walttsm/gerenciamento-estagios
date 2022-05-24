<?php

namespace App\View\Components;

use App\Models\Aluno;
use Illuminate\View\Component;

class editAlunoModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Aluno $aluno)
    {
        //
        $this->aluno = $aluno;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alunoModal')->with('aluno', $this->aluno);
    }
}
