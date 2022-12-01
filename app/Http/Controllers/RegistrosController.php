<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Registro;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class RegistrosController extends Controller
{
    public function listarRegistros(){
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        
        $r = Registro::where('orientador_id',$orientador->id)
                ->orderBy('updated_at','desc')
                ->get();
        
        $a = [];
        foreach($r as $registro){
            array_push($a, Aluno::where('id', $registro->aluno_id)
                ->get());
        }
        return view('orientador.registrospage', ['registros' => $r, 'alunos' => $a]);
    }

    public function criarRegistros(Request $request){
        $r = new Registro;
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        $r->orientador_id = $orientador->id;
        $r->data_orientacao = $request->data_orientacao." ".$request->data;
        $r->assunto = $request->assunto;
        $r->prox_assunto = $request->prox_assunto;
        $r->observacao = $request->observacao;
        if($request->presenca == null){
            $r->presenca = 0;
        }else{
            $r->presenca = $request->presenca;
        }
        $r->aluno_id = $request->aluno_id;
        $r->save();

        return redirect('orientador/registros');
    }
    public function create(){
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();

        $a = Aluno::where('orientador_id', $orientador->id)
            ->get();

        return view('orientador.criaregistros', ['alunos' => $a]);
    }

    public function deleteRegistro($id){
        $registro = Registro::find($id);
        $registro->delete();

        return redirect('/orientador/registros');
    }
    
    public function edit($id){
        $r = Registro::find($id);
        $data = explode(" ", $r->data_orientacao);

        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();

        $dia_mes = $data[0];
        $hora = $data[1];

        $a = Aluno::where('orientador_id', $orientador->id)
            ->get();

        $aluno_select = Aluno::where('id', $r->aluno_id)->first();

        return view('orientador.editregistro',['r' => $r, 'alunos' => $a, 'hora' => $hora, 'dia_mes' => $dia_mes, 'aluno_select' => $aluno_select]);
    }
    public function editRegistros(Request $request, $id){
        $r = Registro::find($id);

        $data_orientacao = $request->data_orientacao." ".$request->data;
        $assunto = $request->assunto;
        $prox_assunto = $request->prox_assunto;
        $observacao = $request->observacao;
        if($request->presenca == null){
            $presenca = 0;
        }else{
            $presenca = $request->presenca;
        }
        $aluno_id = $request->aluno_id;
        $data = array('data_orientacao'=>$data_orientacao,'assunto'=>$assunto, 'prox_assunto'=>$prox_assunto, 'observacao'=>$observacao, 'presenca'=>$presenca
        , 'aluno_id'=>$aluno_id);
        $r->update($data);
        
        return redirect('/orientador/registros');
    }

    public function infoRegistro($id){
        $r = Registro::find($id);
        $aluno = Aluno::where('id', $r->aluno_id)->first();
        return view('orientador.inforegistro', ['registro' => $r, 'aluno' => $aluno]);
    }
}
