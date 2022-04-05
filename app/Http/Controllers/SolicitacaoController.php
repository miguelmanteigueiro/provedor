<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    public function show(Solicitacao $solicitacao)
    {
        return view('solicitacao.showOne', ['solicitacao' => $solicitacao]);
    }

    public function store ()
    {
        return view('solicitacao.criar');
    }
}
