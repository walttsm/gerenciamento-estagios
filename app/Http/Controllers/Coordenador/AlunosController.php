<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Turma;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Response;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\View
     */
    public function index(Request $request)
    {
        $filtro_nome = $request['filtro_nome'];

        if (!$request['filtro_turma']) {
            $filtro_turma = date('Y');
        } else {
            $filtro_turma = ($request['filtro_turma'] == 'Todos os alunos') ?
                $filtro_turma = null :
                $request['filtro_turma'];
        }

        $orientadores = array_map(function ($item) {
            return $item['nome'];
        }, Orientador::select('nome')->orderBy('nome', 'asc')->get()->toArray());

        $alunos = Aluno::sortable('nome_aluno')->select('*')
            ->when($filtro_nome, function ($query, $filtro_nome) {
                $query->where('nome_aluno', 'LIKE', '%' . $filtro_nome . '%');
            })->when($filtro_turma, function ($query, $filtro_turma) {
                $turma = Turma::where('ano', $filtro_turma)->get()->first();
                $query->where([
                    ['turma_id', 'LIKE', '%' . $turma->id . '%']
                ]);
            })->get();

        $turmas = array_map(function ($item) {
            return $item['ano'];
        }, Turma::select('ano')->orderBy('ano', 'desc')->get()->toArray());
        array_unshift($turmas, 'Todos os alunos');

        return view(
            'coordenador.alunos',
            [
                'filtro_nome' => $filtro_nome,
                'filtro_turma' => $filtro_turma,
                'alunos' => $alunos,
                'orientadores' => $orientadores,
                'turmas' => $turmas
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param @param \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $filtro_data_inicio = $request['filtro_data_inicio'] ? $request['filtro_data_inicio'] : null;
        $filtro_data_fim = $request['filtro_data_fim'] ? $request['filtro_data_fim'] : null;
        $filtro_registros = $request['filtro_registros'] ? $request['filtro_registros'] : 'Todos';
        $aluno = Aluno::find($id);

        $aluno->rpods = $aluno->rpods->sortBy('mes');
        $registros = Registro::select('*')->where('aluno_id', '=', $aluno->id)->when($filtro_data_inicio, function ($query, $filtro_data_inicio) {
            $query->where('data_orientacao', '>=', $filtro_data_inicio);
        })->when($filtro_data_fim, function ($query, $filtro_data_fim) {
            $query->where('data_orientacao', '<=', $filtro_data_fim);
        })->get()->sortBy([['data_orientacao', 'desc']]);

        $faltas = Registro::select('*')
            ->where('aluno_id', $aluno->id)
            ->where('presenca', 0)->get()->count();

        return view(
            'coordenador.aluno',
            [
                'aluno' => $aluno,
                'faltas' => $faltas,
                'registros' => $registros,
                'filtro_registros' => $filtro_registros,
                'filtro_data_inicio' => $filtro_data_inicio,
                'filtro_data_fim' => $filtro_data_fim
            ]
        );
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
            'nome_aluno' => 'required',
            'email' => 'required|unique:alunos,email',
            'matricula' => 'required|unique:alunos,matricula',
            'turma' => 'required',
        ]);

        try {
            $turma = Turma::where('ano', $request['turma'])->get()->first();
            $orientador = Orientador::where('nome', $request['orientador'])->get()->first();
            $banca1 = Orientador::where('nome', $request['banca1'])->get()->first();
            $banca2 = Orientador::where('nome', $request['banca2'])->get()->first();
            // dd($banca1, $banca2);
            // $user = new User([
            //     'name' => $request['nome_aluno'],
            //     'email' => $request['email'],
            //     'password' => hash('md5', '12345'),
            // ]);

            // $user->save();

            // $user = User::where('name', $user->name)->get()->first();
            // $user_id = $user->id;

            $aluno = new Aluno([
                'nome_aluno' => $request['nome_aluno'],
                'curso' => $request['curso'],
                'matricula' => $request['matricula'],
                'email' => $request['email'],
                'nome_trabalho' => $request['titulo'],
                'turma_id' => $turma['id'],
                // 'user_id' => $user_id,
                'orientador_id' => $orientador['id'],
                'banca1_id' => $banca1->id,
                'banca2_id' => $banca2->id,
            ]);

            $aluno->save();
            $message = "Aluno criado com sucesso!";
            $type = 'success';
        } catch (Exception $e) {
            DB::rollback();
            $message = 'Houve um erro ao inserir os alunos, confira os dados e tente novamente!';
            $type = 'error';
        }
        return redirect()->route('alunos.index')->with(['message' => $message, 'type' => $type]);
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
        try {
            $request->validate([
                'nome_aluno' => 'required',
                'email' => 'required',
                'matricula' => 'required',
                'turma' => 'required',
            ]);

            $turma = Turma::where('ano', $request['turma'])->get()->first();
            $orientador = Orientador::where('nome', $request['orientador'])->get()->first();
            $banca1 = Orientador::where('nome', $request['banca1'])->get()->first();
            $banca2 = Orientador::where('nome', $request['banca2'])->get()->first();
            $aluno = Aluno::find($id);

            $aluno->nome_aluno = $request['nome_aluno'];
            $aluno->curso = $request['curso'];
            $aluno->matricula = $request['matricula'];
            $aluno->email = $request['email'];
            $aluno->nome_trabalho = $request['titulo'];
            $aluno->turma_id = $turma['id'];
            $aluno->orientador_id = $orientador['id'];
            $aluno->banca1_id = $banca1['id'];
            $aluno->banca2_id = $banca2['id'];

            $aluno->save();
            $message = "Aluno editado com sucesso!";
        } catch (Exception $e) {
            $message = "Erro ao editar aluno, tente novamente!";
            DB::rollBack();
        }

        return redirect()->route('alunos.index')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Aluno::find($id);
        User::destroy($aluno->user_id);
        $aluno->delete();

        return redirect()->route('alunos.index')->with(['message' => "Aluno deletado com sucesso!"]);
    }
}
