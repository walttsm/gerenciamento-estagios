<?php
require __DIR__.'/auth.php';

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
require __DIR__.'/auth.php';

Route::get('/rpodpage', function(){
    return view('aluno/rpodpage');
});

// Rotas de geração de declarações
Route::get('/coordenador/declaracoes', [CoordenadorController::class, 'show_geracao']);
Route::post('/coordenador/gerar_declaracoes', [CoordenadorController::class, 'gerar_declaracoes']);
Route::view('/coordenador/modelo_declaracao', 'coordenador.modelo.declaracao');
Route::get('/coordenador/modelo_declaracao/{aluno}', [CoordenadorController::class, 'gerar_declaracao']);
