<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Models\AnexosSolicitacao;
use App\Models\EstadoSolicitacao;
use App\Models\Log;
use App\Models\Solicitacao;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SolicitacaoController extends Controller
{
    // Consultar uma solicitação
    public function consultar(Solicitacao $solicitacao)
    {
        // Receber o estado da solicitação e os seus anexos
        $estado = $solicitacao->estado_solicitacao;
        $anexos = $solicitacao->anexo_solicitacao;

        // Carregar os comentários de uma solicitação
        $comentarios = $solicitacao->comentario;

        // Mostrar a página de consulta
        return view('solicitacao.consultar',   ['solicitacao'   => $solicitacao, 
                                                'estado'        => $estado, 
                                                'anexos'        => $anexos, 
                                                'comentarios'   => $comentarios]);
    }
    // Mostrar o formulário para criar uma solicitação
    public function showForm()
    {
        return view('solicitacao.criar');
    }

    // Guardar uma solicitação
    public function storeForm(Request $request)
    {
        $failedUploads = 0;

        $atributos = ['referencia_interna'  => '<b>Referência Interna</b>',
                      'situacao_academica'  => '<b>Situação Académica</b>',
                      'estudante_id'        => '<b>Número de Estudante</b>',
                      'estudante_nome'      => '<b>Nome</b>',
                      'estudante_email'     => '<b>Endereço de Email</b>',
                      'estudante_telefone'  => '<b>Contacto Telefónico</b>',
                      'descricao'           => '<b>Descrição da Ocorrência</b>',
                      'ficheiros.*'         => '<b>Ficheiros</b>'];

        $validator = Validator::make($request->all(), [
            // Campos da solicitação
            'referencia_interna'    => 'max:12|unique:solicitacoes|nullable',
            'situacao_academica'    => 'required',
            'estudante_id'          => 'nullable|integer|max:100000',
            'estudante_nome'        => 'required|max:255',
            'estudante_email'       => 'required|email|max:255',
            'estudante_telefone'    => 'nullable|max:255',
            'descricao'             => 'required',  
            'ficheiros.*'           => 'file|max:2048|mimes:pdf,jpg,jpeg,png',
            'data_inicio'           => 'required|date_format:Y-m-d'
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
        $estado_solicitacao->solicitacao_id = $id;
        $estado_solicitacao->save();

        // Caso haja ficheiros, guardar os mesmos
        if($request->hasfile('ficheiros')){ 

            // Caminho único para cada solicitação
            $path = "anexos/" . $id;

            foreach($request->file('ficheiros') as $file){
                $filename = $file->getClientOriginalName();
                
                // Verificar se o ficheiro já foi carregado
                if(Storage::exists($path . "/" . $filename)){
                    $failedUploads++;
                }

                else{
                    $storedFilePath = $file->storeAs($path, $filename);
                    $parsedFilePath = str_replace("public", "", $storedFilePath);
                 
                    $anexos_solicitacao = new AnexosSolicitacao(['solicitacao_id' => $id, 'path' => $parsedFilePath]);
                    $anexos_solicitacao->save();
                }
            }
        }

        // Envio de notificação por email aquando da inserção de uma solicitação
        // Notificação no dashboard sobre possíveis erros
        // O envio é feito apenas para as contas ativas

        try{
            Mail::bcc(User::where('conta_ativa', '=', '1')->get('email'))
            ->queue(new Notification());
        }

        catch(Exception $e) {
            if($failedUploads !== 0){
                return redirect('/dashboard')->with('aviso', 'A solicitação foi guardada com sucesso, mas ' . $failedUploads . ' ficheiro(s) não foram carregados. O aviso por email não foi enviado.');
            }

            return redirect('/dashboard')->with('aviso', 'A solicitação foi guardada com sucesso, mas o aviso por email não foi enviado.');
        }

        if($failedUploads !== 0){
            return redirect('/dashboard')->with('aviso', 'A solicitação foi guardada com sucesso, mas ' . $failedUploads . ' ficheiro(s) não foram carregados.');
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
        $id = $request->solicitacao_id;
        $failedUploads = 0;

        $atributos = ['referencia_interna'  => '<b>Referência Interna</b>',
                      'situacao_academica'  => '<b>Situação Académica</b>',
                      'estudante_id'        => '<b>Número de Estudante</b>',
                      'estudante_nome'      => '<b>Nome</b>',
                      'estudante_email'     => '<b>Endereço de Email</b>',
                      'estudante_telefone'  => '<b>Contacto Telefónico</b>',
                      'descricao'           => '<b>Descrição da Ocorrência</b>',
                      'motivo_edicao'       => '<b>Motivo da Edição</b>',
                      'ficheiros.*'         => '<b>Ficheiros</b>'];

        $validator = Validator::make($request->all(), [
            // Campos da solicitação
            'referencia_interna' => [
                'max:12', 
                'nullable',
                Rule::unique('solicitacoes')->ignore($request->solicitacao_id, 'solicitacao_id')
            ],

            'situacao_academica'    => 'required',
            'estudante_id'          => 'nullable|integer|max:100000',
            'estudante_nome'        => 'required|max:255',
            'estudante_email'       => 'required|email|max:255',
            'estudante_telefone'    => 'nullable|max:255',
            'descricao'             => 'required',  
            'ficheiros.*'           => 'file|max:2048|mimes:pdf,jpg,jpeg,png',
            'data_inicio'           => 'required|date_format:Y-m-d',
            'motivo_edicao'         => 'required|min:8|max:255'
        ], [], $atributos);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        // Guardar a solicitação editada em caso de sucesso
        Solicitacao::where('solicitacao_id', $id)->update($request->except('_token', 'data_inicio', 'ficheiros', 'motivo_edicao'));
        EstadoSolicitacao::where('solicitacao_id', $id)->update(['data_inicio' => $request->get('data_inicio')]);

        // Guardar no log o motivo da edição
        $log = new Log(['solicitacao_id' => $id, 'utilizador_id' => Auth::user()->id, 'data_edicao' => new DateTime(), 'motivo_edicao' => $request->get('motivo_edicao')]);
        $log->save();

        // Caso haja ficheiros, guardar os mesmos
        if($request->hasfile('ficheiros')){ 

            // Caminho único para cada solicitação
            $path = "anexos/" . $id;

            foreach($request->file('ficheiros') as $file){
                $filename = $file->getClientOriginalName();
                
                    // Verificar se o ficheiro já foi carregado
                    if(Storage::exists($path . "/" . $filename)){
                        $failedUploads++;
                    }

                    else{
                        $storedFilePath = $file->storeAs($path, $filename);
                        $parsedFilePath = str_replace("public", "", $storedFilePath);
                    
                        $anexos_solicitacao = new AnexosSolicitacao(['solicitacao_id' => $id, 'path' => $parsedFilePath]);
                        $anexos_solicitacao->save();
                    }
                }
        }   	

        // Mensagem de aviso, se houver ficheiros não carregados
        if($failedUploads !== 0){
            return redirect('/dashboard')->with('aviso', 'A solicitação foi editada com sucesso, mas ' . $failedUploads . ' ficheiro(s) não foram carregados.');
        }

        return redirect('/dashboard')->with('sucesso', 'Solicitação editada com sucesso!');
    }

    public function arquivar(Solicitacao $solicitacao)
    {
        EstadoSolicitacao::where('solicitacao_id', $solicitacao->solicitacao_id)->update(['estado' => 'arquivado']);
        return redirect('/dashboard')->with('sucesso', 'A solicitação foi arquivada!');
    }

    public function desarquivar(Solicitacao $solicitacao)
    {
        EstadoSolicitacao::where('solicitacao_id', $solicitacao->solicitacao_id)->update(['estado' => 'aberto']);
        return redirect('/dashboard')->with('sucesso', 'A solicitação foi desarquivada!');
    }
}
