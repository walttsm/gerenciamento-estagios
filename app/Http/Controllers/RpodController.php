<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\rpodcreateRequests;
use App\Http\Requests\Auth\rpodeditRequest;
use Illuminate\Support\Facades\Storage;

use App\Models\Rpod;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class RpodController extends Controller
{
    public function listarRpods(){
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();
        
        $rpod = Rpod::where('aluno_id',$aluno->id)
                ->orderBy('mes','desc')
                ->get();

        $rpod_h = Rpod::where('aluno_id',$aluno->id)
                ->sum('horas_mes');
                
        return view('aluno.rpodpage', ['rpods' => $rpod, 'rpod_h' => $rpod_h]);
    }

    public function criarRpods(rpodcreateRequests $request){
        $rpod = new Rpod;
        $id_user = Auth::user()->id;
        $aluno = Aluno::where('user_id', $id_user)->first();

        $rpod->mes = $request->mes;
        $rpod->horas_mes = $request->horas_mes;
        $rpod->aluno_id = $aluno->id;
        $rpod->orientador_id = $aluno->orientador_id;
        
        
        if($request->hasFile('local_arquivo')){
            $file = $request->local_arquivo;
            $rpod->rpod_title = $file->getClientOriginalName();
            $rpod->local_arquivo = $file->store('RpodAlunos');
        }
            
        $rpod->save();

        return redirect('aluno/rpodpage');
    }
    public function create(){
        return view('aluno.criarpod');
    }

    public function downloadRpod($id){
        $rpod = Rpod::find($id);   
        $file = $rpod->local_arquivo;
        return Storage::download($file, $rpod->rpod_title);
    }

    public function deleteRpod($id){
        $rpod = Rpod::find($id);
        $file = $rpod->local_arquivo;
        Storage::deleteDirectory($file);
        $rpod->delete();

        return redirect('/aluno/rpodpage');
    }
    
    public function edit($id){
        $rpod = Rpod::find($id);
        $directory = $rpod->local_arquivo . "/" . $rpod->rpod_title;
                
        return view('aluno.editrpod',['rpods' => $rpod, 'arq_rpod' => $directory]);
    }
    public function editRpods(rpodeditRequest $request, $id){
        $rpod = Rpod::find($id);

        if($request->hasFile('local_arquivo') && $request->file('local_arquivo')->isValid()){
            Storage::deleteDirectory($rpod->local_arquivo);
            
            $reqArq = $request->local_arquivo;
            
            $rpod->rpod_title = $reqArq->getClientOriginalName();
            $rpod->local_arquivo = md5(strtotime("now") . $reqArq->getClientOriginalName());

            $arqNome = $rpod->local_arquivo . "/" . $rpod->rpod_title;
            Storage::disk('local')->put($arqNome, file_get_contents($request->file('local_arquivo')));
        }

        $data = $request->only('mes', 'horas_mes');
        $rpod->update($data);

        return redirect('/aluno/rpodpage');
    }

}
