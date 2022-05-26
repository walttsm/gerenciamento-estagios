<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Turma;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\View
     */
    public function index(Request $request)
    {
        $orientadores = Orientador::all('nome');
        $nomes = array();
        foreach ($orientadores as $orientador) {
            array_push($nomes, $orientador->nome);
        }
        if ($request['filtro_nome']) {
            $filtro_nome = $request['filtro_nome'];
            $alunos = Aluno::sortable('nome_aluno')->select('*')->where([
                ['nome_aluno', 'LIKE', '%' . $filtro_nome . '%']
            ])->get();
        } else {
            $alunos = Aluno::sortable('nome_aluno')->select('*')->get();
        }

        return view('coordenador.alunos', ['alunos' => $alunos, 'orientadores' => $nomes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
            'nome_aluno'=> 'required',
            'email'=> 'required|unique:alunos,email',
            'matricula' => 'required|unique:alunos,matricula',
            'turma' => 'required',
        ]);

        $turma = Turma::where('ano', $request['turma'])->get()->first();
        $orientador = Orientador::where('nome', $request['orientador'])->get()->first();
        $user = new User([
            'name' => $request['nome_aluno'],
            'email' => $request['email'],
            'password' => hash('md5', '12345'),
        ]);

        $user->save();

        $user = User::where('name', $user->name)->get()->first();
        $user_id = $user->id;

        $aluno = new Aluno([
            'nome_aluno' => $request['nome_aluno'],
            'curso' => $request['curso'],
            'matricula' => $request['matricula'],
            'email' => $request['email'],
            'nome_trabalho' => $request['titulo'],
            'turma_id' => $turma['id'],
            'user_id' => $user_id,
            'orientador_id' => $orientador['id'],
        ]);

        $aluno->save();
        return redirect()->route('alunos.index')->with(['message' => "Aluno criado com sucesso!"]);
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
        try {
            $request->validate([
                'nome_aluno'=> 'required',
                'email'=> 'required',
                'matricula' => 'required',
                'turma' => 'required',
            ]);

            $turma = Turma::where('ano', $request['turma'])->get()->first();
            $orientador = Orientador::where('nome', $request['orientador'])->get()->first();
            $aluno = Aluno::find($id);

            $aluno->nome_aluno = $request['nome_aluno'];
            $aluno->curso = $request['curso'];
            $aluno->matricula = $request['matricula'];
            $aluno-> email = $request['email'];
            $aluno->nome_trabalho = $request['titulo'];
            $aluno->turma_id = $turma['id'];
            $aluno->orientador_id = $orientador['id'];

            $aluno->save();
            $message = "Aluno editado com sucesso!";
        } catch (Exception $e) {
            $message = "Erro ao editar aluno, tente novamente!";
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

        return redirect()->route('alunos.index')->with(['message' => "Usuário deletado com sucesso!"]);
    }
}
