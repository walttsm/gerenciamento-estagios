<?php
require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordenadorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__ . '/auth.php';

// ROTAS ALUNO

Route::get('/rpodpage', function () {
    return view('aluno/rpodpage');
});


// ROTAS ORIENTADOR
Route::get('/orientador/rpods', function () {
    return view('orientador.rpods');
})->name('orientador_rpods');

Route::get('/orientador/orientandos', function () {
    return view('orientador.orientandos');
})->name('orientador_orientandos');

Route::get('/orientador/orientacoes', function () {
    return view('orientador.orientacoes');
})->name('orientador_orientacoes');

// ROTAS COORDENADOR

Route::get('/avisos', function () {
    return view('common.avisos');
})->name('avisos');

Route::get('/coordenador/orientadores', function () {
    return view('coordenador.orientadores');
})->name('orientadores');

Route::get('/coordenador/alunos', function () {
    return view('coordenador.alunos');
})->name('alunos');

// Rotas de geração de declarações
Route::get('/coordenador/declaracoes', [CoordenadorController::class, 'show_geracao'])->name('declaracoes');
Route::post('/coordenador/declaracoes', [CoordenadorController::class, 'gerar_declaracoes']);
Route::view('/coordenador/modelo_declaracao', 'coordenador.modelo.declaracao_modelo');
Route::get('/coordenador/modelo_declaracao/{aluno}', [CoordenadorController::class, 'gerar_declaracao'])->name('gerar_declaracao');
