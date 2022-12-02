<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aviso;
use App\Models\Aluno;
use App\Models\AlunosAviso;
use App\Models\Orientador;
use Illuminate\Support\Facades\Auth;

class AvisoController extends Controller
{
    public function listarAvisosOrientador()
    {
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        $avisos = Aviso::where('orientador_id', $orientador->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $alunos = [];
        $aluno = [];
        $avisosAluno = [];
        
        foreach($avisos as $aa){
            array_push($avisosAluno, AlunosAviso::where('aviso_id', $aa->id)->get());
        }
        
        foreach ($avisosAluno as $aa) {
            foreach($aa as $a){
                array_push($aluno, Aluno::where('id', $a->aluno_id)
                    ->first());
            }
            array_push($alunos, $aluno);
            $aluno = [];
        }


        
        return view('orientador.avisospage', ['avisos' => $avisos, 'alunos' => $alunos]);
    }
    
    public function listarAvisosAluno()
    {
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();

        $avisosAluno = [];
        $orientador = [];
        $avisos = AlunosAviso::where('aluno_id', $aluno->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        foreach($avisos as $a){
            $aviso = Aviso::where('id', $a->aviso_id)->first();
            array_push($avisosAluno, $aviso);
            
            array_push($orientador, Orientador::where('id', $aviso->orientador_id)->first());
        }
                    
                
        return view('aluno.avisospage', ['avisos' => $avisosAluno, 'orientador' => $orientador]);
    }

    public function create()
    {
        if (Auth::user()->permissao == 3) {
            $a = Aluno::all();
        } else {
            $orientador = Orientador::where('user_id', Auth::user()->id)->first();
            $a = Aluno::where('orientador_id', $orientador->id)->get();
        }

        return view('orientador.criaravisos', ['alunos' => $a]);
    }

    public function criarAvisos(Request $request)
    {
        $a = new Aviso;
        $a->aviso_titulo = $request->aviso_titulo;
        $a->aviso_conteudo = $request->aviso_conteudo;
        $alunos = $request->alunos;

        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        $a->orientador_id = $orientador->id;
        $a->save();
        foreach($alunos as $aluno){
            $aviso_aluno = new AlunosAviso;
            $aviso_aluno->aviso_id = $a->id;
            $aviso_aluno->aluno_id = $aluno;
            $aviso_aluno->save();
        }
        return redirect('orientador/avisos');
    }

    public function deleteAviso($id)
    {
        $aviso = Aviso::find($id);
        $aviso->delete();

        return redirect('/orientador/avisos');
    }
}
