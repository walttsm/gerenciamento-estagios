<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Turma;
use Exception;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{
    //
    public function store(Request $request)
    {

        $request->validate([
            'ano' => 'required|unique:turmas,ano',
            'codigo' => 'required|unique:turmas,codigo',
        ]);

        try {

            $turma = new Turma();
            $turma->ano = $request['ano'];
            $turma->codigo = $request['codigo'];

            $turma->save();
            $message = "Turma criada com sucesso!";
            $type = 'success';
        } catch (Exception $e) {
            $message = "Erro ao criar turma";
            $type = 'error';
            DB::rollback();
        }


        return redirect()->route('alunos.index')->with(['message' => $message, 'type' => $type]);
    }
}
