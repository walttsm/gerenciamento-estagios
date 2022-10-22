<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\Documento;

class DocumentosController extends Controller
{
    public function listarDocsAluno(){
        $doc = Documento::all();

        return view('aluno.docpage', ['documents' => $doc]);
    }

    public function listarDocs(){
        $doc = Documento::all();

        return view('coordenador.docpage', ['documents' => $doc]);
    }

    public function criarDocs(Request $request){
        $doc = new Documento;
        $doc->doc_nome = $request->doc_nome;

        if($request->hasFile('local_arquivo')){
            $file = $request->local_arquivo;
            $doc->arquivo_title = $file->getClientOriginalName();
            $doc->local_arquivo = $file->store('DocumentosEstagio');
        }
        $doc->save();
        return redirect('coordenador/documentos');
    }

    public function create(){
        return view('coordenador.criardoc');
    }

    public function downloadDoc($id){
        $doc = Documento::find($id);
        $file = $doc->local_arquivo;
        return Storage::download($file, $doc->arquivo_title);
    }

    public function deleteDoc($id){
        $doc = Documento::find($id);
        $file = $doc->local_arquivo;
        Storage::delete($file);
        $doc->delete();

        return redirect('coordenador/documentos');
    }

    public function edit($id){
        $doc = Documento::find($id);
        $directory = $doc->local_arquivo;
                
        return view('coordenador.editdoc',['doc' => $doc, 'arq_doc' => $directory]);
    }
    public function editDoc(Request $request, $id){
        $doc = Documento::find($id);

        if($request->hasFile('local_arquivo')){
            $file = $doc->local_arquivo;
            Storage::delete($file);

            $file = $request->local_arquivo;
            $doc->arquivo_title = $file->getClientOriginalName();
            $doc->local_arquivo = $file->store('DocumentosEstagio');
        }
        $data = $request->only('doc_nome');
        $doc->update($data);
        return redirect('/coordenador/documentos');
    }
}
