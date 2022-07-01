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

        $user = new User([
            "name" => $request['nome'],
            "email" => $request['email'],
            "password" => hash('md5', '12345'),
        ]);

        $user->save();

        $created_user = User::where('email', $user->email)->get()->first();
        $created_user_id = $created_user->id;

        $orientador = new Orientador([
            "nome" => $request['nome'],
            "email" => $request['email'],
            "curso" => $request['curso'],
            "user_id" => $created_user_id,
        ]);

        $orientador->save();

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
        //
    }
}
