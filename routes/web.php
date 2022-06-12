<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnaliticaController;
use App\Http\Controllers\BackupsController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Route;

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

# Página de Autenticação e Controlo de Sessões
Route::redirect('/', 'login');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('verify', [SessionsController::class, 'auth'])->middleware('guest');
Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');


# Utilizador geral
Route::get('dashboard', [DashboardController::class, 'show'])->middleware('auth');
    # Consultar definições
Route::get('definicoes', [DashboardController::class, 'definicoes'])->middleware('auth');
    # Alterar dados pessoais
Route::post('/definicoes/changeName', [DashboardController::class, 'changeName'])->middleware('auth');
Route::post('/definicoes/changeEmail', [DashboardController::class, 'changeEmail'])->middleware('auth');
Route::post('/definicoes/changePassword', [DashboardController::class, 'changePassword'])->middleware('auth');


# Solicitações
    # Registar nova solicitação
Route::get('/solicitacao/novo', [SolicitacaoController::class, 'showForm'])->middleware('auth');
Route::post('/solicitacao/guardar', [SolicitacaoController::class, 'storeForm'])->middleware('auth');
    # Consultar solicitação
Route::get('/solicitacao/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'consultar'])->middleware('auth');
    # Editar solicitação
Route::get('/solicitacao/editar/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'showEditForm'])->middleware('auth')->name('editar');
Route::post('/solicitacao/editar/', [SolicitacaoController::class, 'confirmEditForm'])->middleware('auth');
    # Consultar arquivo
Route::get('arquivo', [DashboardController::class, 'arquivo'])->middleware('auth');
    # Arquivar e desarquivar
Route::get('/solicitacao/arquivar/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'arquivar'])->middleware('auth');
Route::get('/solicitacao/desarquivar/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'desarquivar'])->middleware('auth');

# Comentários
    # Adicionar novo comentário
Route::get('/comentario/novo/{solicitacao:solicitacao_id}', [ComentarioController::class, 'showCommentForm'])->middleware('auth')->name('novo_comentario');
Route::post('/comentario/guardar', [ComentarioController::class, 'storeCommentForm'])->middleware('auth');

# Administração
    # Gerir contas
Route::get('/admin/contas', [AdminController::class, 'view'])->middleware('admin');
    # Editar uma conta
Route::get('/admin/contas/editar/{user:id}', [AdminController::class, 'showEdit'])->middleware('admin');
Route::post('/admin/contas/editar/', [AdminController::class, 'confirmEdit'])->middleware('admin');
    # Ativar e desativar contas
Route::get('/admin/contas/desativar/{user:id}', [AdminController::class, 'deactivate'])->middleware('admin');
Route::get('/admin/contas/ativar/{user:id}', [AdminController::class, 'activate'])->middleware('admin');
    # Registar novas contas
Route::get('/admin/contas/registar', [AdminController::class, 'register'])->middleware('admin');
Route::post('/admin/contas/registar', [AdminController::class, 'store'])->middleware('admin');

    # Backups
Route::get('/admin/backups', [BackupsController::class, 'view'])->middleware('admin');


    # Analítica
Route::get('/admin/analitica', [AnaliticaController::class, 'view'])->middleware('admin');
        # Gerir assuntos
Route::get('/admin/analitica/assuntos', [AnaliticaController::class, 'showAssuntos'])->middleware('admin');
        # Adicionar assunto
Route::get('/admin/analitica/assuntos/adicionar', [AnaliticaController::class, 'showAddAssuntos'])->middleware('admin');
Route::post('/admin/analitica/assuntos/adicionar', [AnaliticaController::class, 'confirmAddAssuntos'])->middleware('admin');
        # Editar assunto
Route::get('/admin/analitica/assuntos/editar/{assunto:assunto_id}', [AnaliticaController::class, 'editAssunto'])->middleware('admin');
Route::post('/admin/analitica/assuntos/editar/', [AnaliticaController::class, 'confirmEditAssunto'])->middleware('admin');
        # Gerir naturezas
Route::get('/admin/analitica/naturezas', [AnaliticaController::class, 'showNaturezas'])->middleware('admin');
        # Adicionar natureza
Route::get('/admin/analitica/naturezas/adicionar', [AnaliticaController::class, 'showAddNatureza'])->middleware('admin');
Route::post('/admin/analitica/naturezas/adicionar', [AnaliticaController::class, 'confirmAddNatureza'])->middleware('admin');
        # Editar natureza
Route::get('/admin/analitica/naturezas/editar/{natureza:natureza_id}', [AnaliticaController::class, 'editNatureza'])->middleware('admin');
Route::post('/admin/analitica/naturezas/editar/', [AnaliticaController::class, 'confirmEditNatureza'])->middleware('admin');
        # Gerir analítica da solicitação
Route::get('/admin/analitica/{solicitacao:solicitacao_id}', [AnaliticaController::class, 'manageAnalitica'])->middleware('admin');
Route::post('/analitica/guardar', [AnaliticaController::class, 'saveAnalitica'])->middleware('auth');
