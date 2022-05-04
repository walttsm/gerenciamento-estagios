<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;
use App\Models\Orientador;
use Spatie\Browsershot\Browsershot;

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
        $savefolder = realpath('./').'/declaracoes_geradas/';
        /*Browsershot::url(route('gerar_declaracao', ['aluno' => $aluno]))
        ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
        ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
        ->format('A4')
        ->save('/home/walter/declaracao.pdf');*/
        $string =view('coordenador.modelo.declaracao', ['aluno' => $aluno])->render();

        Browsershot::html($string)
        ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
        ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
        ->timeout(120)
        ->emulateMedia("screen")
        ->format('A4')
        ->savePdf($savefolder.'declaracao '.$aluno->nome_aluno.'.pdf');

        return view('coordenador.modelo.declaracao', ['aluno' => $aluno]);
    }
}
