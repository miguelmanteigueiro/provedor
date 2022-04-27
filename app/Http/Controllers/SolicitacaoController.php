<?php

namespace App\Http\Controllers;

use App\Models\AnexosSolicitacao;
use App\Models\EstadoSolicitacao;
use App\Models\Solicitacao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Type\Integer;

class SolicitacaoController extends Controller
{
    // Consultar uma solicitação
    public function consultar(Solicitacao $solicitacao)
    {
        // Receber o estado da solicitação e os seus anexos
        $estado = $solicitacao->estado_solicitacao;
        $anexos = $solicitacao->anexo_solicitacao;

        // Mostrar a página de consulta
        return view('solicitacao.consultar', ['solicitacao' => $solicitacao, 'estado' => $estado, 'anexos' => $anexos]);
    }
    // Mostrar o formulário para criar uma solicitação
    public function showForm()
    {
        return view('solicitacao.criar');
    }

    // Guardar uma solicitação
    public function storeForm(Request $request)
    {
        $atributos = ['referencia_interna' => '<b>Referência Interna</b>',
                      'situacao_academica' => '<b>Situação Académica</b>',
                      'estudante_id' => '<b>Número de Estudante</b>',
                      'estudante_nome' => '<b>Nome</b>',
                      'estudante_email' => '<b>Endereço de Email</b>',
                      'estudante_telefone' => '<b>Contacto Telefónico</b>',
                      'descricao' => '<b>Descrição da Ocorrência</b>'];

        $validator = Validator::make($request->all(), [
            // Campos da solicitação
            'referencia_interna' => 'max:12|unique:solicitacoes|nullable',
            'situacao_academica' => 'required',
            'estudante_id' => 'nullable|numeric', // PRECISA DE FIX!!!!!!!!!!!!!!!!!!!!!!!!
            'estudante_nome' => 'required|max:255',
            'estudante_email' => 'required|email|max:255',
            'estudante_telefone' => 'nullable|max:255',
            'descricao' => 'required',  

            'ficheiros.*' => 'mimes:pdf,jpg,jpeg,png',
            'data_inicio' => 'required|date'
        ], [], $atributos);

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

                $storedFilePath = $file->storeAs($path, $filename);
                $parsedFilePath = str_replace("public", "", $storedFilePath);
                
                $anexos_solicitacao = new AnexosSolicitacao(['solicitacao_id' => $id, 'path' => $parsedFilePath]);
                $anexos_solicitacao->save();
            }
        }

        return redirect('/dashboard')->with('sucesso', 'Solicitação guardada com sucesso!');
    }

    // Mostrar o formulário para editar uma solicitação
    public function showEditForm(Solicitacao $solicitacao)
    {
        // Receber o estado da solicitação e os seus anexos
        $estado = $solicitacao->estado_solicitacao;
        $anexos = $solicitacao->anexo_solicitacao;

        // Mostrar a página de consulta
        return view('solicitacao.edit', ['solicitacao' => $solicitacao, 'estado' => $estado, 'anexos' => $anexos]);
    }

    // Mostrar o formulário para editar uma solicitação
    public function confirmEditForm(Request $request)
    {
        #dd($request);

        $atributos = ['referencia_interna' => '<b>Referência Interna</b>',
        'situacao_academica' => '<b>Situação Académica</b>',
        'estudante_id' => '<b>Número de Estudante</b>',
        'estudante_nome' => '<b>Nome</b>',
        'estudante_email' => '<b>Endereço de Email</b>',
        'estudante_telefone' => '<b>Contacto Telefónico</b>',
        'descricao' => '<b>Descrição da Ocorrência</b>',
        'motivo_edicao' => '<b>Motivo da Edição</b>'];

        $validator = Validator::make($request->all(), [
            // Campos da solicitação
            'referencia_interna' => [
                'max:12', 
                'nullable',
                Rule::unique('solicitacoes')->ignore($request->solicitacao_id, 'solicitacao_id')],
            'situacao_academica' => 'required',
            'estudante_id' => 'nullable|numeric', // PRECISA DE FIX!!!!!!!!!!!!!!!!!!!!!!!!
            'estudante_nome' => 'required|max:255',
            'estudante_email' => 'required|email|max:255',
            'estudante_telefone' => 'nullable|max:255',
            'descricao' => 'required',  

            'ficheiros.*' => 'mimes:pdf,jpg,jpeg,png',
            'data_inicio' => 'required|date',
            'motivo_edicao' => 'required|max:255'
        ], [], $atributos);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

}
