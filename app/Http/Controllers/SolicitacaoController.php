<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SolicitacaoController extends Controller
{
    public function show(Solicitacao $solicitacao)
    {
        return view('solicitacao.showOne', ['solicitacao' => $solicitacao]);
    }

    public function showForm()
    {
        return view('solicitacao.criar');
    }

    public function storeForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Campos da solicitação

            'referencia_interna' => 'max:12|unique:solicitacoes',
            'situacao_academica' => 'required',
            'estudante_id' => 'nullable|numeric',
            'estudante_nome' => 'required|max:255',
            'estudante_email' => 'required|email',
            'estudante_telefone' => 'nullable|numeric',
            'descricao' => 'required',  

        ]);
 
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Guardar solicitação em caso de sucesso
        $solicitacao = new Solicitacao($request->except('_token', 'data_inicio', 'ficheiros'));
        $solicitacao->utilizador_id = Auth::user()->id;
        $solicitacao->save();

        dd($solicitacao->id);

        // Adicionar o estado da solicitação
    }
}
