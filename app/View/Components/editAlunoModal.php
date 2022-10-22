<?php

namespace App\View\Components;

use App\Models\Aluno;
use Illuminate\View\Component;

class editAlunoModal extends Component
{
    public $aluno;
    public $turma;
    public $orientador;
    public $orientadores;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aluno, $turma, $orientador, $orientadores)
    {
        //
        $this->aluno = $aluno;
        $this->turma = $turma;
        $this->orientador = $orientador;
        $this->orientadores = $orientadores;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-aluno-modal');
    }
}
