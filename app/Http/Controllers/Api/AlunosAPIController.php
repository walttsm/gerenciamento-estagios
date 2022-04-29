<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunosAPIController extends Controller
{
    //
    /**
     * Returns all alunos in the database
     * 
     * @return array $alunos
     */
    public function getAll(Request $request) {
        $alunos = Aluno::all();
        return $alunos;
    }
}
