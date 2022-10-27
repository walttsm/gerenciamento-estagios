<?php

namespace App\Http\Controllers\Orientador;

use App\Http\Controllers\Controller;
use App\Models\Orientador;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrientadorController extends Controller
{
    //


    public function show()
    {
        $user = Auth::user();
        $orientador = Orientador::select()->where('email', '=', $user->email)->get()->first();

        return View('orientador.orientacoes', ['orientador' => $orientador]);
    }
}
