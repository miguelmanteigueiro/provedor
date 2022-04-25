<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SolicitacaoController;
use App\Models\Solicitacao;
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
Route::post('verify', [SessionsController::class, 'store'])->middleware('guest');
Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');

# Utilizador geral
Route::get('dashboard', [DashboardController::class, 'show'])->middleware('auth');
Route::get('definicoes', [DashboardController::class, 'definicoes'])->middleware('auth');

# Solicitações
    # Registar nova solicitação
Route::get('/solicitacao/novo', [SolicitacaoController::class, 'showForm'])->middleware('auth');
Route::post('/solicitacao/guardar', [SolicitacaoController::class, 'storeForm'])->middleware('auth');
    # Consultar solicitação
Route::get('/solicitacao/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'consultar'])->middleware('auth');
    # Editar solicitação
Route::get('/solicitacao/editar/{solicitacao:solicitacao_id}', [SolicitacaoController::class, 'showEditForm'])->middleware('auth');
Route::post('/solicitacao/editar', [SolicitacaoController::class, 'confirmEditForm'])->middleware('auth');

# Administração
Route::get('/admin', [AdminController::class, 'admin_dashboard']);#->middleware('auth');

Route::get('/admin/register', [AdminController::class, 'register']);#->middleware('auth');
Route::post('/admin/register', [AdminController::class, 'store']);#->middleware('auth');