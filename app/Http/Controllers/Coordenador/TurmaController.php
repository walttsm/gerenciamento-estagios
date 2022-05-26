<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Turma;

class TurmaController extends Controller
{
    //
    public function store(Request $request) {

        $request->validate([
            'ano' => 'required|unique:turmas,ano',
            'codigo' => 'required|unique:turmas,codigo',
        ]);
        $turma = new Turma();
        $turma->ano = $request['ano'];
        $turma->codigo = $request['codigo'];

        $turma->save();


        return redirect()->route('alunos.index')->with(['message' => 'Turma criada com sucesso!']);
    }
}
