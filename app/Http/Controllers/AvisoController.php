<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aviso;
use App\Models\Aluno;
use App\Models\Orientador;

class AvisoController extends Controller
{
    public function listarAvisosOrientador(){
        // $id_user = Auth::user()->id;
        $avisos = Aviso::where('orientador_id', 1)
                ->get();
        $alunos = [];
        $al = [];
        foreach($avisos as $a){
            
            foreach(json_decode($a->alunos) as $j){
                array_push($al, Aluno::where('id', $j)
                ->get());
            }
            array_push($alunos, $al);
            $al = [];
        }
        return view('orientador.avisospage', ['avisos' => $avisos, 'alunos' => $alunos]);
    }
    public function listarAvisosAluno(){
        // $id_user = Auth::user()->id;
        $avisos = Aviso::all();

        $avisosAluno = [];
        $orientador = [];
        foreach($avisos as $a){
            foreach(json_decode($a->alunos) as $j){
                if($j == 18){
                    array_push($avisosAluno, $a);
                    array_push($orientador, Orientador::where('id', $a->orientador_id)->first());
                }
            }
        }
        return view('aluno.avisospage', ['avisos' => $avisosAluno, 'orientador' => $orientador]);
    }

    public function create(){
        $a = Aluno::where('orientador_id', 1)
            ->get();

        return view('orientador.criaravisos', ['alunos' => $a]);
    }

    public function criarAvisos(Request $request){
        $a = new Aviso;
        $a->aviso_titulo = $request->aviso_titulo;
        $a->aviso_conteudo = $request->aviso_conteudo;
        $a->alunos = json_encode($request->alunos);

        // $id_user = Auth::user()->id;
        $a->orientador_id = 1;
        $a->save();
        return redirect('orientador/avisos');
    }

    public function deleteAviso($id){
        $aviso = Aviso::find($id);
        $aviso->delete();

        return redirect('/orientador/avisos');
    }
}
