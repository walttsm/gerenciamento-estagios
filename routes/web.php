<?php
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\R;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/rpodpage', [RpodController::class, "listarRpods"]);

Route::post('/rpodpage', [RpodController::class, "criarRpods"]);
Route::get('/rpodpage/adicionar', [RpodController::class, "create"]);

Route::get('/rpodpage/delete/{id}', [RpodController::class, "deleteRpod"])->name('rpodpage.delete');
Route::get('/rpodpage/download/{id}', [RpodController::class, "downloadRpod"])->name('rpodpage.download');

// Rotas de geração de declarações
Route::get('/coordenador/declaracoes', [CoordenadorController::class, 'show_geracao']);
Route::post('/coordenador/gerar_declaracoes', [CoordenadorController::class, 'gerar_declaracao']);

