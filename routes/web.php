<?php
require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\Coordenador\DeclaracaoController;
use App\Http\Controllers\Coordenador\AlunosController;
use App\Http\Controllers\Coordenador\OrientadoresController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

require __DIR__ . '/auth.php';

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ROTAS EM COMUM
Route::get('/avisos', function () {
    return view('common.avisos');
})->name('avisos');


// ROTAS ALUNO
Route::prefix('/aluno')->middleware('auth')->controller(AlunoController::class)->group(function() {
    Route::get('/rpodpage', function () {
        return view('aluno/rpodpage');
    });
});

// ROTAS ORIENTADOR
Route::prefix('/orientador')->middleware('auth')->controller(OrientadorController::class)->group(function() {
    Route::get('/rpods', function () {
        return view('orientador.rpods');
    })->name('orientador_rpods');

    Route::get('/orientandos', function () {
        return view('orientador.orientandos');
    })->name('orientador_orientandos');

    Route::get('/orientacoes', function () {
        return view('orientador.orientacoes');
    })->name('orientador_orientacoes');
});


// ROTAS COORDENADOR
Route::prefix('/coordenador')->middleware('auth')->controller(DeclaracaoController::class)->group(function () {

    Route::resources([
        'alunos' => AlunosController::class,
        'orientadores' => OrientadoresController::class,
    ]);

    // Rotas de geração de declarações
    Route::get('declaracoes', 'create')->name('declaracoes');
    Route::post('declaracoes', 'gerar_declaracoes');
    Route::view('modelo_declaracao', 'coordenador.modelo.declaracao_modelo');
    Route::get('modelo_declaracao/{aluno}', 'gerar_declaracao')->name('gerar_declaracao');
});
