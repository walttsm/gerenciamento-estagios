<?php

namespace App\Http\Controllers\Coordenador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Spatie\Browsershot\Browsershot;
use ZipArchive;

use App\Http\Controllers\Controller;

use App\Models\Aluno;

class DeclaracaoController extends Controller
{
    //
    /**
     * Display the view
     */
    public function create(Request $request)
    {
        $alunos = Aluno::sortable(['turma_id' => 'desc'])->select('*')->get();

        return view(
            'coordenador.declaracoes',
            ['alunos' => $alunos]
        );
    }

    /**
     * Generate the selected students documents
     */
    public function gerar_declaracoes(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        if (!Storage::exists('/zips')) {
            Storage::makeDirectory('/public/zips');
        }
        if (!Storage::exists('/temp')) {
            Storage::makeDirectory('/public/temp');
        }

        $zip_file = storage_path() . '/zips/declaracoes' . date('d-m-Y') . '.zip';

        $zipper = new ZipArchive();
        $zipper->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($request['data'] as $id) {
            $aluno = Aluno::find($id);
            $savepath = storage_path() . '/temp/declaracao ' . $aluno->matricula . '-' . $aluno->nome_aluno  . '.pdf';

            if (!Storage::exists($savepath)) {
                $string = view('coordenador.modelo.declaracao', ['aluno' => $aluno])->render();

                Browsershot::html($string)
                    ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
                    ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
                    ->timeout(120)
                    ->emulateMedia("screen")
                    ->format('A4')
                    ->savePdf($savepath);
            }

            $zipper->addFile($savepath, $aluno->matricula . '-' . $aluno->nome_aluno . '.pdf');
        }

        $zipper->close();

        return response()->download($zip_file);
    }

    /**
     * Generate a single declaration
     */
    public function gerar_declaracao(Aluno $aluno)
    {

        if (!Storage::exists('/temp')) {
            Storage::makeDirectory('/public/temp');
        }

        $savepath = storage_path() . '/temp/declaracao ' . $aluno->nome_aluno . '.pdf';

        if (!Storage::exists($savepath)) {
            $string = view('coordenador.modelo.declaracao', ['aluno' => $aluno])->render();

            Browsershot::html($string)
                ->setNodeBinary('/home/walter/.local/share/nvm/v17.9.0/bin/node')
                ->setNpmBinary('/home/walter/.local/share/nvm/v17.9.0/bin/npm')
                ->timeout(120)
                ->emulateMedia("screen")
                ->format('A4')
                ->savePdf($savepath);
        }

        return response()->download($savepath);
    }
}
