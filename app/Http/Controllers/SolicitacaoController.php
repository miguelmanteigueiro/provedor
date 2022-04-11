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

        $solicitacao = new Solicitacao();
        
        $solicitacao->utilizador_id = Auth::user()->id;
        $solicitacao->referencia_interna = $request->referencia_interna;
        $solicitacao->situacao_academica = $request->situacao_academica;
        $solicitacao->estudante_id = $request->estudante_id;
        $solicitacao->estudante_nome = $request->estudante_nome;
        $solicitacao->estudante_email = $request->estudante_email;
        $solicitacao->estudante_telefone = $request->estudante_telefone;
        $solicitacao->descricao = $request->descricao;

        $solicitacao->save();
    }
}
