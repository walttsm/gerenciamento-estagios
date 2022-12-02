<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orientador;
use App\Models\Horario_orientacao;
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

    public function orientacoesAlunoPage(){
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();
        
        $orientacao = Horario_orientacao::where('aluno_id', $aluno->id)->first();

        $orientador = Orientador::where('id', $orientacao->orientador_id)->first();
        $nome_orientador = $orientador->nome;

        $weekDays = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        $calendarData = ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'];

        $hora = $orientacao->hora;
        switch ($orientacao->dia) {
            case 2:
                $dia = 'Segunda';
                break;
            case 3:
                $dia = 'Terça';
                break;
            case 4:
                $dia = 'Quarta';
                break;
            case 5:
                $dia = 'Quinta';
                break;
            case 6:
                $dia = 'Sexta';
                break;
            case 7:
                $dia = 'Sábado';
                break;
        }
        return view('aluno.orientacoes', compact('weekDays', 'calendarData', 'dia', 'hora', 'nome_orientador'));
    }

    public function orientacoesOrientadorPage(){
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        
        $orientacoes = Horario_orientacao::where('orientador_id', $orientador->id)
                        ->get();

        $weekDays = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        $calendarData = ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'];
    
        $horas = [];
        $dias = [];
        $nome_aluno = [];
        foreach($orientacoes as $o){
            array_push($horas, $o->hora);
            $a = Aluno::where('id', $o->aluno_id)->first();
            array_push($nome_aluno, $a->nome_aluno);
            switch ($o->dia) {
                case 2:
                    array_push($dias, 'Segunda');
                    break;
                case 3:
                    array_push($dias, 'Terça');
                    break;
                case 4:
                    array_push($dias, 'Quarta');
                    break;
                case 5:
                    array_push($dias, 'Quinta');
                    break;
                case 6:
                    array_push($dias, 'Sexta');
                    break;
                case 7:
                    array_push($dias, 'Sábado');
                    break;
            }   
        }
        return view('orientador.orientacoes', compact('weekDays', 'calendarData', 'dias', 'horas', 'nome_aluno'));
    }
}
