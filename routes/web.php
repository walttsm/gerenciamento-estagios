<?php
require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RpodController;
use App\Http\Controllers\Coordenador\DeclaracaoController;
use App\Http\Controllers\Coordenador\AlunosController;
use App\Http\Controllers\Coordenador\OrientadoresController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Coordenador\OrientacoesController;
use App\Http\Controllers\Coordenador\TurmaController;
use App\Http\Controllers\Orientador\RegistroController;
use App\Http\Controllers\Coordenador\CSVController;

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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// Route::get('/rpodpage', [RpodController::class, "listarRpods"]);

Route::post('/rpodpage', [RpodController::class, "criarRpods"]);
Route::get('/rpodpage/adicionar', [RpodController::class, "create"]);

Route::get('/rpodpage/delete/{id}', [RpodController::class, "deleteRpod"])->name('rpodpage.delete');
Route::get('/rpodpage/download/{id}', [RpodController::class, "downloadRpod"])->name('rpodpage.download');


require __DIR__ . '/auth.php';

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ROTAS EM COMUM
Route::get('/avisos', function () {
    return view('common.avisos');
})->name('avisos');


// ROTAS ALUNO
Route::prefix('/aluno')->middleware(['auth', 'permissao.acesso'])->controller(AlunoController::class)->group(function () {
    Route::get('/rpodpage', [RpodController::class, "listarRpods"]);
});

// ROTAS ORIENTADOR
Route::prefix('/orientador')->middleware(['auth', 'permissao.acesso'])->controller(OrientadorController::class)->group(function () {
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
Route::prefix('/coordenador')->middleware(['auth', 'permissao.acesso'])->group(function () {

    Route::resources([
        'alunos' => AlunosController::class,
        'orientadores' => OrientadoresController::class,
        'orientacoes' => OrientacoesController::class,
    ]);

    Route::get('{orientador_id}/registros', [RegistroController::class, 'index'])->name('registrosCoord');

    Route::post('/turma', [TurmaController::class, 'store'])->name('turma.store');

    // Rotas de geração de declarações
    Route::get('declaracoes', [DeclaracaoController::class, 'create'])->name('declaracoes');
    Route::post('declaracoes', [DeclaracaoController::class, 'gerar_declaracoes']);
    Route::view('modelo_declaracao', 'coordenador.modelo.declaracao_modelo');
    Route::get('modelo_declaracao/{aluno}', [DeclaracaoController::class, 'gerar_declaracao'])->name('gerar_declaracao');

    Route::prefix('/csv')->group(function () {
        Route::post('/alunos', [CSVController::class, 'cadastrar_alunos'])->name('alunos_csv');
    });
});
