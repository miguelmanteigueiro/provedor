<?php

namespace App\Http\Controllers;

use App\Models\AnexosComentario;
use App\Models\Comentario;
use App\Models\Solicitacao;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    /**
     * Devolver a view da página para adicionar um comentário
     *
     * @param Solicitacao $solicitacao
     * @return view('comentario.novo')
     */
    public function showCommentForm (Solicitacao $solicitacao)
    {
        return view('comentario.novo', ['solicitacao' => $solicitacao]);
    }

    /**
     * Método para tratar a adição de um comentário
     *
     * @param Request $request
     * @return Confirmação de adição de comentário
     */
    public function storeCommentForm (Request $request)
    {
        $id = $request->get('solicitacao_id');

        $failedUploads = 0;

        $atributos = ['comentario'  => '<b>Comentário</b>',
                      'ficheiros.*' => '<b>Ficheiros</b>'];

        $validator = Validator::make($request->all(), [
            // Campos do comentário
            'comentario'    => 'required',
            'ficheiros.*'   => 'file|max:2048|mimes:pdf,jpg,jpeg,png',
        ], [], $atributos);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Guardar comentário em caso de sucesso
        $comentario = new Comentario($request->only('solicitacao_id', 'comentario'));
        $comentario->data_comentario = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $comentario->utilizador_id = Auth::user()->id;
        $comentario->save();
        $id_comentario = $comentario->id;

        // Caso haja ficheiros, guardar os mesmos
        if($request->hasfile('ficheiros')){

            // Caminho único para cada comentário
            $path = "anexos/" . $id . "/comentarios";

            foreach($request->file('ficheiros') as $file){
                $filename = $file->getClientOriginalName();

                    // Verificar se o ficheiro já foi carregado
                    if(Storage::exists($path . "/" . $filename)){
                        $failedUploads++;
                    }

                    else{
                        $storedFilePath = $file->storeAs($path, $filename);
                        $parsedFilePath = str_replace("public", "", $storedFilePath);

                        $anexos_comentario = new AnexosComentario(['comentario_id' => $id_comentario, 'path' => $parsedFilePath]);
                        $anexos_comentario->save();
                    }
                }
        }

        // Mensagem de aviso, se houver ficheiros não carregados
        if($failedUploads !== 0){
            return redirect('/solicitacao/' . $id)->with('aviso', 'O comentário foi adicionado com sucesso, mas ' . $failedUploads . ' ficheiro(s) já foram previamente adicionados.');
        }

        return redirect('/solicitacao/' . $id)->with('sucesso', 'Comentário adicionado com sucesso!');
    }
}
