<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orientador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Aluno;
use App\Models\Rpod;
use App\Models\Atividade;
use App\Models\AtividadeFile;

class OrientandosController extends Controller
{
    public function listarOrientandos(){
        return view('orientador.orientandos');
    }

    public function rpodPages($id){
        $aluno = Aluno::where('id', $id)
                ->first();

        $r = Rpod::where('aluno_id', $id)
            ->orderBy('mes','desc')
            ->get();
        
        $rpod_h = Rpod::where('aluno_id',$id)
            ->sum('horas_mes');

        return view('orientador.rpodalunopage', ['rpods' => $r, 'rpod_h' => $rpod_h, 'aluno' => $aluno]);
    }

    public function atividadePage($id){
        $aluno = Aluno::where('id', $id)
                ->first();
        
        $atividades = Atividade::all();

        $a = AtividadeFile::where('aluno_id', $aluno->id)
                ->get();

        return view('orientador.atividadealunopage', ['atv'=> $atividades, 'envio' => $a, 'aluno' => $aluno]);
    }

    public function infoAtividadeAluno($idAtv, $idAluno){
        $atividades = Atividade::find($idAtv);

        $data = AtividadeFile::where('aluno_id', $idAluno)
                ->where('atividade_id', $idAtv)
                ->orderby('created_at', 'desc')
                ->first();

        $files = AtividadeFile::where('aluno_id', $idAluno)
                ->where('atividade_id', $idAtv)
                ->get();

        if($data == null){
            return view('orientador.infoatividadealunopage', ['atv'=> $atividades, 'entrega' => $data]);
        }else{
            return view('orientador.infoatividadealunopage', ['atv'=> $atividades, 'entrega' => $data, 'files' => $files, 'idAtv' => $idAtv, 'idAluno' => $idAluno]);
        }
        
    }

    public function downloadFile($id){
        $a = AtividadeFile::where('id', $id)
                ->first();

        $local = $a->local_arquivo;
        return Storage::download($local, $a->arquivo_title);
    }
}
