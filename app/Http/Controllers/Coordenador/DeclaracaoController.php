<?php

namespace App\Http\Controllers\Coordenador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Spatie\Browsershot\Browsershot;
use ZipArchive;

use App\Http\Controllers\Controller;

use App\Models\Aluno;
use App\Models\Turma;
use Exception;

class DeclaracaoController extends Controller
{
    //
    /**
     * Mostra a view de geração de declarações.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\
     */
    public function create(Request $request)
    {
        $filtro_nome = $request['filtro_nome'];

        if (!$request['filtro_turma']) {
            $filtro_turma = date('Y');
        } else {
            $filtro_turma = ($request['filtro_turma'] == 'Todos os alunos') ?
                $filtro_turma = null :
                $request['filtro_turma'];
        }

        $alunos = Aluno::sortable('nome_aluno')->select('*')
            ->when($filtro_turma, function ($query, $filtro_turma) {
                $turma = Turma::where('ano', $filtro_turma)->get()->first();
                $query->where([
                    ['turma_id', 'LIKE', '%' . $turma->id . '%']
                ]);
            })->when($filtro_nome, function ($query, $filtro_nome) {
                $query->where([
                    ['nome_aluno', 'LIKE', '%' . $filtro_nome . '%']
                ]);
            })->get();

        $turmas = array_map(function ($item) {
            return $item['ano'];
        }, Turma::select('ano')->orderBy('ano', 'desc')->get()->toArray());
        array_unshift($turmas, 'Todos os alunos');

        return View(
            'coordenador.declaracoes',
            [
                'filtro_nome' => $filtro_nome,
                'filtro_turma' => $filtro_turma,
                'alunos' => $alunos,
                'turmas' => $turmas,
            ]
        );
    }

    /**
     * Esta função gera as declarações dos alunos selecionados pelo coordenador na tabela.
     * @return Illuminate\Contracts\Routing\ResponseFactory::download Zip com as declarações geradas para download.
     */
    public function gerar_declaracoes(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        try {

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
        } catch (Exception $e) {
            return redirect()->route('declaracoes', ['message' => 'Erro ao gerar declarações, tente novamente!', $type = 'error']);
        }
    }

    /**
     * Gera a declaração de um aluno.
     * @return Illuminate\Contracts\Routing\ResponseFactory::download PDF da declaração para download.
     */
    public function gerar_declaracao(Aluno $aluno)
    {

        try {
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
        } catch (Exception $e) {
            return redirect()->route('declaracoes', ['message' => 'Erro ao gerar declarações, tente novamente!', $type = 'error']);
        }
    }
}
