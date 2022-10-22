<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\AtividadeFile;
use Illuminate\Support\Facades\Auth;
use App\Models\Aluno;

use Illuminate\Http\Request;

class AtividadesController extends Controller
{
    public function listarAtividadesAluno(){
        $atividades = Atividade::all();

        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();
        $a = AtividadeFile::where('aluno_id', $aluno->id)
                ->get();
        return view('aluno.atividades', ['atv'=> $atividades, 'envio' => $a]);
    }

    public function listarAtividades(){
        $atividades = Atividade::all();
        return view('coordenador.atividades', ['atv'=> $atividades]);
    }
    
    public function infoAtividade($id){
        $atividades = Atividade::find($id);
        
        return view('coordenador.atividadesinfo', ['atv'=> $atividades]);
    }

    public function deleteAtividade($id){
        $atv = Atividade::find($id);
        $atv->delete();

        return redirect('coordenador/atividades');
    }

    public function criarAtividades(Request $request){
        $atv = new Atividade();
        $atv->nome_atividade = $request->nome_atividade;
        if($request->doc_nome != null){
            $atv->descricao = $request->doc_nome;
        }
        
        $atv->save();
        return redirect('coordenador/atividades');
    }

    public function create(){
        return view('coordenador.criaratv');
    }

    public function edit($id){
        $atv = Atividade::find($id);
        return view('coordenador.editatv',['atv' => $atv]);
    }
    public function editAtividade(Request $request, $id){
        $atv = Atividade::find($id);

        $nome_atividade = $request->nome_atividade;
        if($request->doc_nome != null){
            $descricao = $request->descricao;
        }else{
            $descricao = null;
        }
        $data = $request->only('descricao', 'nome_atividade');
        $atv->update($data);
        return redirect('coordenador/atividades');
    }

    public function infoAtividadeAluno($id){
        $atividades = Atividade::find($id);
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();

        $data = AtividadeFile::where('aluno_id', $aluno->id)
                ->where('atividade_id', $id)
                ->orderby('created_at', 'desc')
                ->first();

        $files = AtividadeFile::where('aluno_id', $aluno->id)
                ->where('atividade_id', $id)
                ->get();

        if($data == null){
            return view('aluno.atividadesinfo', ['atv'=> $atividades, 'entrega' => $data]);
        }else{
            return view('aluno.atividadesinfo', ['atv'=> $atividades, 'entrega' => $data, 'files' => $files]);
        }
        
    }

    public function enviarAtividade(Request $request, $id){
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();
        $files = $request->filenames;
        if($request->hasFile('filenames')){
            foreach($request->filenames as $file){
                $atv = new AtividadeFile;
                $atv->arquivo_title = $file->getClientOriginalName();
                $atv->local_arquivo = $file->store('AtividadesFiles');
                $atv->atividade_id = $id;
                $atv->aluno_id = $aluno->id;
                $atv->save();
            }
        }
        
        return back();
    }

    public function editarEnvioAtividade(Request $request, $id){
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();
        $atv = AtividadeFile::where('aluno_id', $aluno->id)
                ->where('atividade_id', $id)
                ->get();

        $filesAnt = $request->filenamesAnt;
        foreach($atv as $file){
            if (!in_array($file->id, $filesAnt)){
                $file->delete();
            }
        }    

        $files = $request->filenames;
        if($request->hasFile('filenames')){
            foreach($request->filenames as $file){
                $atv = new AtividadeFile;
                $atv->arquivo_title = $file->getClientOriginalName();
                $atv->local_arquivo = $file->store('AtividadesFiles');
                $atv->atividade_id = $id;
                $atv->aluno_id = $aluno->id;
                $atv->save();
            }
        }

        return back();
        
    }
}
