<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(){
        return view('solicitacao.show', ['solicitacoes' => Solicitacao::all()]);
    }
    public function definicoes(){
        return view('dashboard.definicoes');
    }
}
