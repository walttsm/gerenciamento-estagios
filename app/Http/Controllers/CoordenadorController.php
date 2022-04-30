<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;
use App\Models\Orientador;

class CoordenadorController extends Controller
{
    //
    public function show_geracao() {
        $alunos = Aluno::all();

        foreach($alunos as $aluno) {
            $orientador = Orientador::find($aluno['orientador_id']);
            $aluno['orientador'] = $orientador['nome'];
        }

        return view('coordenador.declaracoes',
            ['alunos' => $alunos]);
    }

    public function gerar_declaracoes(Request $request) {
        $request->validate([
        'data' => 'required',
        ]);

        $alunos = json_encode($request['data']);


        //$file = shell_exec();


        return view('coordenador.gerando', ['data' => $alunos]);
    }

    public function gerar_declaracao(Aluno $aluno) {
        return view('coordenador.modelo.declaracao', ['aluno' => $aluno]);
    }
}
