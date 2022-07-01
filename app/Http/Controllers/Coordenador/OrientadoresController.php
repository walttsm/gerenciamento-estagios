<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use App\Models\Orientador;
use App\Models\User;
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
            "nome" => "required",
            "email" => "required",
        ]);

        $user = User::updateOrCreate(
            ['email' => $request['email']],
            [
                "name" => $request['nome'],
                "password" => hash('md5', '12345'),
            ],
        );

        $orientador = Orientador::updateOrCreate(
            ["email" => $request['email']],
            [
                "nome" => $request['nome'],
                "curso" => $request['curso'],
                "user_id" => $user->id,
            ],
        );

        return redirect()->route('orientadores.index')->with(['message' => "Orientador criado com sucesso!"]);
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
        $orientador = Orientador::find($id);
        $orientador->delete();

        return redirect()->route('orientadores.index')->with(['message' => "Orientador deletado com sucesso!"]);
    }
}
