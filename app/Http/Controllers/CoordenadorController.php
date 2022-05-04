<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

use App\Models\Aluno;
use App\Models\Orientador;
use Spatie\Browsershot\Browsershot;

class CoordenadorController extends Controller
{
    //
    public function show_geracao()
    {
        $alunos = Aluno::all();

        foreach ($alunos as $aluno) {
            $orientador = Orientador::find($aluno['orientador_id']);
            $aluno['orientador'] = $orientador['nome'];
        }

        return view(
            'coordenador.declaracoes',
            ['alunos' => $alunos]
        );
    }

    public function gerar_declaracoes(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        //dd(storage_path() . '/zips/declaracoes' . date('d/m/Y') . '.zip');

        if(!Storage::exists('/zips')){
            Storage::makeDirectory('/public/zips');
        }
        if(!Storage::exists('/temp')){
            Storage::makeDirectory('/public/temp');
        }

        $zip_file = storage_path() . '/zips/declaracoes' . date('d-m-Y') . '.zip';

        $zipper = new ZipArchive();
        $zipper->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($request['data'] as $id) {
            $aluno = Aluno::find($id);
            $string = view('coordenador.modelo.declaracao', ['aluno' => $aluno])->render();
            $savepath = storage_path() . '/temp/declaracao ' . $aluno->matricula . '-'. $aluno->nome_aluno  . '.pdf';

            Browsershot::html($string)
                ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
                ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
                ->timeout(120)
                ->emulateMedia("screen")
                ->format('A4')
                ->savePdf($savepath);

            //array_push($filepaths, $savepath);
            $zipper->addFile($savepath, $aluno->matricula . '-'. $aluno->nome_aluno . '.pdf');
        }

        $zipper->close();

        return response()->download($zip_file);

        //return view('coordenador.gerando', ['data' => $alunos]);
    }

    public function gerar_declaracao(Aluno $aluno)
    {
        $savepath = storage_path() . '/temp/declaracao ' . $aluno->nome_aluno . '.pdf';

        $string = view('coordenador.modelo.declaracao', ['aluno' => $aluno])->render();

        Browsershot::html($string)
            ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
            ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
            ->timeout(120)
            ->emulateMedia("screen")
            ->format('A4')
            ->savePdf($savepath);

        //return view('coordenador.modelo.declaracao', ['aluno' => $aluno]);
        return response()->download($savepath);
    }
}
