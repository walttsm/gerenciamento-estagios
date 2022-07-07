<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Horario_orientacao;
use App\Models\Orientador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class OrientacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id' => 'required',
            'dia' => 'required',
            'hora' => 'required',
            'orientador_id' => 'required',
            'deleteHorario' => 'required',
        ]);

        // dd($request);

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
                    'hora' => $request['hora'][$i]
                ];
                $orientacao = Horario_orientacao::Create(
                    [
                        'dia' => $dado['dia'],
                        'hora' => $dado['hora'],
                        'orientador_id' => $request['orientador_id'],
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
