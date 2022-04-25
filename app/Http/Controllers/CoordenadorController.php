<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;

class CoordenadorController extends Controller
{
    //
    public function gerar_declaracao() {
        $alunos = Aluno::all();

        return view('coordenador.declaracoes',
            ['alunos' => $alunos]);
    }
}
