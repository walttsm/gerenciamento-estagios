<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\AtividadesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Coordenador\CSVController;
use App\Http\Controllers\Coordenador\DeclaracaoController;
use App\Http\Controllers\Coordenador\AlunosController;
use App\Http\Controllers\Coordenador\OrientacoesController;
use App\Http\Controllers\Coordenador\OrientadoresController;
use App\Http\Controllers\Coordenador\TurmaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\OrientandosController;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Http\Controllers\Orientador\RegistroController;
use App\Http\Controllers\RpodController;


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


/**
 * Rotas do google
 */
Route::get('/redirect', [LoginController::class, 'redirectToProvider'])->name('google_login'); // Abre a janela de autenticação na mesma janela da página
Route::get('/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ROTAS ALUNO
Route::prefix('/aluno')->middleware(['auth', 'permissao.acesso'])->controller(AlunoController::class)->group(function () {

    //documentos
    Route::get('/documentos', [DocumentosController::class, "listarDocsAluno"])->name('aluno_docpage');
    Route::get('/documentos/download/{id}', [DocumentosController::class, "downloadDoc"])->name('documentos.download');

    //atividades
    Route::get('/atividades', [AtividadesController::class, "listarAtividadesAluno"])->name('aluno_atividades');
    Route::post('/atividades/{id}', [AtividadesController::class, "enviarAtividade"])->name('atividades.enviarAtividade');
    Route::get('/atividades/{id}', [AtividadesController::class, "infoAtividadeAluno"])->name('atividades.infoAtividadeAluno');
    Route::put('/atividades/{id}', [AtividadesController::class, "editarEnvioAtividade"])->name('atividades.editarEnvioAtividade');

    //avisos
    Route::get('/avisos', [AvisoController::class, "listarAvisosAluno"])->name('aluno_avisospage');

    //rpods
    Route::get('/rpodpage', [RpodController::class, "listarRpods"])->name('aluno_rpodpage');
    Route::post('/rpodpage/adicionar', [RpodController::class, "criarRpods"])->name('rpodpage.criarRpods');
    Route::get('/rpodpage/adicionar', [RpodController::class, "create"])->name('rpodpage.create');
    Route::put('/rpodpage/edit/{id}', [RpodController::class, "editRpods"])->name('rpodpage.editRpods');
    Route::get('/rpodpage/edit/{id}', [RpodController::class, "edit"])->name('rpodpage.edit');
    Route::get('/rpodpage/delete/{id}', [RpodController::class, "deleteRpod"])->name('rpodpage.delete');
    Route::get('/rpodpage/download/{id}', [RpodController::class, "downloadRpod"])->name('rpodpage.download');
});

// ROTAS ORIENTADOR
Route::prefix('/orientador')->middleware(['auth', 'permissao.acesso'])->controller(OrientadorController::class)->group(function () {
    Route::get('/rpods', function () {
        return view('orientador.rpods');
    })->name('orientador_rpods');

    // Route::get('/orientandos', function () {
    //     return view('orientador.orientandos');
    // })->name('orientador_orientandos');

    Route::get('/orientacoes', function () {
        return view('orientador.orientacoes');
    })->name('orientador_orientacoes');

    //Registros
    Route::get('/registros', [RegistrosController::class, "listarRegistros"])->name('orientador_registrospage');
    Route::post('/registros/adicionar', [RegistrosController::class, "criarRegistros"])->name('registro.criarRegistros');
    Route::get('/registros/adicionar', [RegistrosController::class, "create"])->name('registro.create');
    Route::put('/registros/edit/{id}', [RegistrosController::class, "editRegistros"])->name('registro.editRegistros');
    Route::get('/registros/edit/{id}', [RegistrosController::class, "edit"])->name('registro.edit');
    Route::get('/registros/delete/{id}', [RegistrosController::class, "deleteRegistro"])->name('registro.delete');
    Route::get('/registros/{id}', [RegistrosController::class, "infoRegistro"])->name('orientador_inforegistro');

    //Avisos
    Route::get('/avisos', [AvisoController::class, "listarAvisosOrientador"])->name('orientador_avisospage');
    Route::post('/avisos/adicionar', [AvisoController::class, "criarAvisos"])->name('aviso.criarAvisos');
    Route::get('/avisos/adicionar', [AvisoController::class, "create"])->name('aviso.create');
    Route::get('/avisos/delete/{id}', [AvisoController::class, "deleteAviso"])->name('aviso.delete');

    //Orientandos
    Route::get('/orientandos', [OrientandosController::class, "listarOrientandos"])->name('orientador_orientandos');
    Route::get('/orientandos/{id}', [OrientandosController::class, "rpodPages"])->name('orientador.rpodPages');
    Route::get('/orientandos/atividade/{id}', [OrientandosController::class, "atividadePage"])->name('orientador.atividadePage');
    Route::get('/orientandos/atividade/{idAtv}/aluno/{idAluno}', [OrientandosController::class, "infoAtividadeAluno"])->name('orientador.infoAtividadeAluno');
    Route::get('/orientandos/atividade/download/{id}', [OrientandosController::class, "downloadFile"])->name('orientador.downloadFile');
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
    // Route::get('modelo_declaracao/{aluno}', [DeclaracaoController::class, 'gerar_declaracao'])->name('gerar_declaracao');

    //Pagina de Documentos
    Route::get('/documentos', [DocumentosController::class, "listarDocs"])->name('coordenador_docpage');
    Route::get('/documentos/download/{id}', [DocumentosController::class, "downloadDoc"])->name('coordenador.documentos.download');
    Route::post('/documentos/adicionar', [DocumentosController::class, "criarDocs"])->name('documentos.criarDocs');
    Route::get('/documentos/adicionar', [DocumentosController::class, "create"])->name('documentos.create');
    Route::get('/documentos/delete/{id}', [DocumentosController::class, "deleteDoc"])->name('documentos.delete');
    Route::put('/documentos/edit/{id}', [DocumentosController::class, "editDoc"])->name('documentos.editDoc');
    Route::get('/documentos/edit/{id}', [DocumentosController::class, "edit"])->name('documentos.edit');

    //Pagina de Atividades
    Route::get('/atividades', [AtividadesController::class, "listarAtividades"])->name('coordenador_atividades');

    Route::post('/atividades/adicionar', [AtividadesController::class, "criarAtividades"])->name('atividades.criarAtividades');
    Route::get('/atividades/adicionar', [AtividadesController::class, "create"])->name('atividades.create');
    Route::get('/atividades/{id}', [AtividadesController::class, "infoAtividade"])->name('atividade.infoAtividade');
    Route::get('/atividades/delete/{id}', [AtividadesController::class, "deleteAtividade"])->name('atividades.delete');
    Route::get('/atividades/edit/{id}', [AtividadesController::class, "edit"])->name('atividades.edit');
    Route::put('/atividades/edit/{id}', [AtividadesController::class, "editAtividade"])->name('atividades.editAtividade');
    Route::get('modelo_declaracao/{aluno}/{banca}', [DeclaracaoController::class, 'gerar_declaracao'])->name('gerar_declaracao');

    Route::prefix('/csv')->group(function () {
        Route::post('/alunos', [CSVController::class, 'cadastrar_alunos'])->name('alunos_csv');
        Route::post('/orientadores', [CSVController::class, 'cadastrar_orientadores'])->name('orientadores_csv');
    });
});
