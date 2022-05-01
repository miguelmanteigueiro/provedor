<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;

class DashboardController extends Controller
{
    public function show(){
        return view('solicitacao.show', [ 'solicitacoes' => Solicitacao::paginate(15) ]);
    }
    public function definicoes(){
        return view('dashboard.definicoes');
    }
    public function arquivo(){
        return view('solicitacao.arquivo');
    }
}
