<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function showCommentForm (Solicitacao $solicitacao)
    {
        return view('comentario.novo', ['solicitacao' => $solicitacao]);
    }

    public function storeCommentForm (Request $request)
    {
        dd($request->all());
    }
}
