<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Horario_orientacao;
use App\Models\Orientador;
use App\Models\User;
use App\Models\Registro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrientadoresController extends Controller
{
    /**
     * Mostra a página de listagem dos orientadores.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro_nome = $request['filtro_nome'];
        $orientadores = Orientador::sortable('nome')->when($filtro_nome, function ($query, $filtro_nome) {
            $query->where('nome', 'LIKE', '%' . $filtro_nome . '%');
        })->get();

        return response()->view(
            'coordenador.orientadores',
            [
                'orientadores' => $orientadores,
                'filtro_nome' => $filtro_nome
            ],
            200
        );
    }

    /**
     * Mostra a página de um orientador com suas orientações semanais e registros de orientação.
     *
     * @param int $id -> Id do orientador a ser acessado.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $id)
    {
        $filtro_registros = $request['filtro_registros'] ? $request['filtro_registros'] : 'Todos';
        $orientador = Orientador::find($id);
        $alunos = $orientador->alunos;

        $orientador->horarios_orientacao = $orientador->horarios_orientacao->sortBy(['dia', 'hora']);

        $alunos = array_map(function ($item) {
            return $item['nome_aluno'];
        }, $orientador->alunos->toArray());

        $faltas = array();

        foreach ($orientador->alunos as $aluno) {
            $n = Registro::select('*')
                ->where('aluno_id', $aluno->id)
                ->where('presenca', 0)->get()->count();
            $faltas[$aluno->id] = $n;
        }

        return response(View(
            'coordenador.orientador',
            [
                'orientador' => $orientador,
                'alunos' => $alunos,
                'filtro_registros' => $filtro_registros,
                'faltas' => $faltas,
            ]
        ));
    }

    /**
     * Salva um novo Orientador no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nome" => "required",
            "email" => "required",
        ]);

        try {
            // $user = User::updateOrCreate(
            //     ['email' => $request['email']],
            //     [
            //         "name" => $request['nome'],
            //         "password" => hash('md5', '12345'),
            //     ],
            // );

            $orientador = Orientador::where('email', $request['email'])->first();

            if (!$orientador) {
                $orientador = new Orientador([
                    "nome" => $request['nome'],
                    "curso" => $request['curso'],
                    "email" => $request['email']
                ]);
            } else {
                if ($orientador->trashed()) {
                    $orientador->restore();
                }
                $orientador->nome = $request['nome'];
                $orientador->curso = $request['curso'];
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
        } catch (Exception $e) {
            $message = "Erro ao criar orientador." . $e;
            $type = "error";
            DB::rollBack();
        }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
    }

    /**
     * Atualiza o orientador no banco de dados após edição
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id -> Id do orientador sendo editado.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'email' => 'required | email',
                'curso' => 'required',
            ]);

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
            DB::rollBack();
        }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
    }

    /**
     * Apaga o orientador da base de dados.
     *
     * @param  int  $id -> Id do orientador.
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
            $type = "error";
            DB::rollBack();
        }

        return redirect()->route('orientadores.index')->with(['message' => $message, 'type' => $type]);
    }
}
