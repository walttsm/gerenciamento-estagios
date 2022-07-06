<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Horario_orientacao;
use App\Models\Orientador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class OrientadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orientadores = Orientador::sortable()->get();

        return response()->view('coordenador.orientadores', ['orientadores' => $orientadores], 200);
    }

    public function show($id)
    {
        $orientador = Orientador::find($id);
        dd($orientador->horarios_orientacao);
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
        // dd($request);
        $request->validate([
            "nome" => "required",
            "email" => "required",
        ]);

        // try {
            $user = User::updateOrCreate(
                ['email' => $request['email']],
                [
                    "name" => $request['nome'],
                    "password" => hash('md5', '12345'),
                ],
            );

            $orientador = Orientador::where('email', $request['email'])->first();

            if (!$orientador) {
                $orientador = new Orientador([
                    "nome" => $request['nome'],
                    "curso" => $request['curso'],
                    "user_id" => $user->id,
                    "email" => $request['email']
                ]);
            } else {
                if ($orientador->trashed()) {
                    $orientador->restore();
                }
                $orientador->nome = $request['nome'];
                $orientador->curso = $request['curso'];
                $orientador->user_id = $user->id;
                if ($request['email'] != $orientador->email) {
                    $orientador->email = $request['email'];
                }
            }

            $orientador->save();

            $dias_disponiveis = count($request['dias']);
            if ($dias_disponiveis != 0) {
                for ($i = 0; $i < $dias_disponiveis; $i++) {
                    $orientacao = new Horario_orientacao([
                        'dia' => $request['dias'][$i],
                        'hora' => $request['horas'][$i],
                        'orientador_id' => $orientador->id,
                    ]);

                    $orientacao->save();
                }
            }



            $message = "Orientador criado com sucesso!";
            $type = "success";
        // } catch (Exception $e) {
            // $message = "Erro ao criar orientador." . $e;
            // $type = "error";
        // }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
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
        try {
            $request->validate([
                'nome' => 'required',
                'email' => 'required | email',
                'curso' => 'required',
            ]);

            dd($request);

            $orientador = Orientador::find($id);

            $orientador->nome = $request["nome"];
            $orientador->email = $request["email"];
            $orientador->curso = $request["curso"];

            $orientador->save();
            $message = "Orientador editado com sucesso";
            $type = "success";
        } catch (Exception $e) {
            $message = "Erro ao editar orientador, tente novamente!";
            $type = "error";
        }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $orientador = Orientador::find($id);
            $orientador->delete();
            $message = "Orientador deletado com sucesso!";
            $type = "success";
        } catch (Exception $e) {
            $message = "Erro ao deletar orientador! Tente novamente!";
            $type = "success";
        }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
    }
}
