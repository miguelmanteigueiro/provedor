<?php

namespace App\Http\Controllers;

use App\Models\AnexosSolicitacao;
use App\Models\EstadoSolicitacao;
use App\Models\Solicitacao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SolicitacaoController extends Controller
{
    // Consultar uma solicitação
    public function consultar(Solicitacao $solicitacao)
    {
        return view('solicitacao.consultar', ['solicitacao' => $solicitacao]);
    }

    // Mostrar o formulário para criar uma solicitação
    public function showForm()
    {
        return view('solicitacao.criar');
    }

    // Guardar uma solicitação
    public function storeForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Campos da solicitação
            'referencia_interna' => 'max:12|unique:solicitacoes|nullable',
            'situacao_academica' => 'required',
            'estudante_id' => 'nullable|numeric',
            'estudante_nome' => 'required|max:255',
            'estudante_email' => 'required|email',
            'estudante_telefone' => 'nullable|max:255',
            'descricao' => 'required',  

            'ficheiros.*' => 'mimes:pdf,jpg,jpeg,png',
            'data_inicio' => 'required|date',
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
        $id = $solicitacao->id;

        // Adicionar o estado da solicitação e adicionar a data de início
        $estado_solicitacao = new EstadoSolicitacao($request->only('data_inicio'));
        $estado_solicitacao->estado = 'aberto';
        $estado_solicitacao->solicitacao_id = $solicitacao->id;
        $estado_solicitacao->save();

        // Caso haja ficheiros, guardar os mesmos
        if($request->hasfile('ficheiros')){

            // Caminho único para cada solicitação
            $path = "anexos/" . $id;

            foreach($request->file('ficheiros') as $file){
                $filename = $file->getClientOriginalName();
                $file->storeAs($path, $filename);

                $anexos_solicitacao = new AnexosSolicitacao(['solicitacao_id' => $id, 'path' => $path . $filename]);
                $anexos_solicitacao->save();
            }
        }

        return redirect('/dashboard')->with('sucesso', 'Solicitação guardada com sucesso!');
    }
}
