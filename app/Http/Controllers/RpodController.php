<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use App\Http\Requests\rpodRequests;
use Illuminate\Support\Facades\Storage;

use App\Models\Rpod;
use App\Models\Aluno;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Session\Session;

class RpodController extends Controller
{
    public function listarRpods(){
        $rpod = Rpod::where('aluno_id', 18)
                ->orderBy('mes','desc')
                ->get();
        $rpod_h = Rpod::where('aluno_id',18)
                ->sum('horas_mes');
                

        return view('aluno/rpodpage', ['rpods' => $rpod, 'rpod_h' => $rpod_h]);
    }

    public function criarRpods(rpodRequests $request){
        $rpod = new Rpod;

        $rpod->mes = $request->mes;
        $rpod->horas_mes = $request->horas_mes;
        $rpod->aluno_id = 18;
        $rpod->orientador_id = 1;
        
        if($request->hasFile('local_arquivo') && $request->file('local_arquivo')->isValid()){
            $reqArq = $request->local_arquivo;
            
            $rpod->rpod_title = $reqArq->getClientOriginalName();
            $rpod->local_arquivo = md5(strtotime("now") . $reqArq->getClientOriginalName());

            $arqNome = $rpod->local_arquivo . "/" . $rpod->rpod_title;
            Storage::disk('local')->put($arqNome, file_get_contents($request->file('local_arquivo')));
            
        }
            
        $rpod->save();

        return redirect('/rpodpage');
    }
    public function create(){
        return view('aluno.criarpod');
    }

    public function downloadRpod($id){
        $rpod = Rpod::find($id);   
        $file = $rpod->local_arquivo."/".$rpod->rpod_title;
        return Storage::download($file);
    }

    public function deleteRpod($id){
        $rpod = Rpod::find($id);
        $file = $rpod->local_arquivo;
        Storage::deleteDirectory($file);
        $rpod->delete();

        return redirect('/rpodpage');
    }
    
}
