<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionsController;
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

# Página de Autenticação
Route::redirect('/', 'login');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->name('logout')->middleware('auth');

# Utilizador geral
Route::get('dashboard', [DashboardController::class, 'dashboard']);#->middleware('auth');

# Administração
Route::get('/admin', [AdminController::class, 'admin_dashboard']);#->middleware('auth');

Route::get('/admin/register', [AdminController::class, 'register']);#->middleware('auth');
Route::post('/admin/register', [AdminController::class, 'store']);#->middleware('auth');