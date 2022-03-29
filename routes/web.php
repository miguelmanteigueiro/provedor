<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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
Route::get('/', [LoginController::class, 'homepage'])->name('login');

# Utilizador geral
Route::get('/dashboard', [DashboardController::class, 'dashboard']);

# Administração
Route::get('/admin', [AdminController::class, 'admin_dashboard']);

Route::get('/admin/register', [AdminController::class, 'register']);
Route::post('/admin/register', [AdminController::class, 'store']);