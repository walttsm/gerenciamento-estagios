<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Horario_orientacao;
use App\Models\Orientador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class OrientacoesController extends Controller
{

    /**
     * Armazena os horários de orientação no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'dia' => 'required',
            'hora' => 'required',
            'orientador_id' => 'required',
            'aluno' => 'required',
        ]);

        try {
            $orientacoes_antigas = Horario_orientacao::where('orientador_id', $request['orientador_id'])->get();

            foreach ($orientacoes_antigas as $orientacao) {
                $deletando = Horario_orientacao::find($orientacao->id);
                $orientacao->delete();
            }

            for ($i = 0; $i < count($request['dia']); $i++) {

                $dado = [
                    'id' => $request['id'][$i],
                    'dia' => $request['dia'][$i],
                    'hora' => $request['hora'][$i],
                    'nome_aluno' => $request['aluno'][$i],
                ];
                $aluno = Aluno::where('nome_aluno', $dado['nome_aluno'])->first();
                $orientacao = Horario_orientacao::Create(
                    [
                        'dia' => $dado['dia'],
                        'hora' => $dado['hora'],
                        'orientador_id' => $request['orientador_id'],
                        'aluno_id' => $aluno->id,
                    ]
                );
            }

            $message = 'Horários de orientação salvos com sucesso!';
            $type = 'success';
            $status = 201;
        } catch (Exception $e) {
            foreach ($orientacoes_antigas as $orientacao) {
                $orientacao->save();
            }
            $message = 'Problema na inserção de horários, tente novamente.';
            $type = 'error';
            $status = 500;
        }

        return redirect(route('orientadores.show', $request['orientador_id']), $status)->with(['message' => $message, 'type' => $type]);
    }
}
