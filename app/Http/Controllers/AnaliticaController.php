<?php

namespace App\Http\Controllers;

use App\Models\Analitica;
use App\Models\Assunto;
use App\Models\AssuntoAnalitica;
use App\Models\EstadoSolicitacao;
use App\Models\Natureza;
use App\Models\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnaliticaController extends Controller
{
    /**
     * Devolver a view da página de gestão de analíticas para as solicitações
     *
     * @return view('components.analitica.analitica')
     */
    public function view(){
        $solicitacoes = Solicitacao::paginate(15);
        return view('components.analitica.analitica', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Devolver a view da página de gestão de analíticas
     *
     * @return view('components.analitica.gerir-analitica')
     */
    public function manageAnalitica(Solicitacao $solicitacao){
        $ESTADOS = ['aberto', 'encerrado', 'arquivado'];
        $naturezas = Natureza::all();
        $assuntos = Assunto::all();

        return view('components.analitica.gerir-analitica',
            ['solicitacao'          => $solicitacao,
             'estados'              => $ESTADOS,
             'naturezas'            => $naturezas,
             'assuntos'             => $assuntos]
        );
    }

    /**
     * Método para guardar a analítica de uma solicitação
     *
     * @param Request $request
     * @return Confirmação de criação de analítica
     */
    public function saveAnalitica(Request $request){
        $analitica = Analitica::where('solicitacao_id', $request->get('solicitacao_id'))->first();

        $atributos =   ['data_inicio'           => '<b>Data de Inserção</b>',
                        'data_resposta'         => '<b>Data de Resposta</b>',
                        'data_fecho_previsto'   => '<b>Data de Fecho Previsto</b>',
                        'data_encerramento'     => '<b>Data de Encerramento</b>',
                        'estado'                => '<b>Estado</b>',
                        'tipo_solicitacao'      => '<b>Tipo de Solicitação</b>',
                        'forma_contacto'        => '<b>Forma de Contacto</b>',
                        'apresentacao'          => '<b>Forma de Apresentação</b>',
                        'ciclo_estudos'         => '<b>Ciclo de Estudos</b>',
                        'curso'                 => '<b>Curso</b>',
                        'genero'                => '<b>Género</b>',
                        'faculdade'             => '<b>Faculdade</b>',
                        'follow_up'             => '<b><i>Follow-up</i></b>'];

        // Validar os dados
        $validator = Validator::make($request->all(), [
            'data_inicio'           => 'required|date_format:Y-m-d',
            'data_resposta'         => 'nullable|date_format:Y-m-d',
            'data_fecho_previsto'   => 'nullable|date_format:Y-m-d',
            'data_encerramento'     => 'nullable|date_format:Y-m-d',
            'estado'                => 'required',
            'tipo_solicitacao'      => 'required',
            'forma_contacto'        => 'required',
            'apresentacao'          => 'required',
            'ciclo_estudos'         => 'required',
            'curso'                 => 'nullable|min:2|max:100',
            'genero'                => 'required',
            'faculdade'             => 'required',
            'follow_up'             => 'nullable'
        ], [], $atributos);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        // Registar uma nova entrada na base de dados
        if($analitica == null){
            $a = new Analitica(['solicitacao_id'    => $request->get('solicitacao_id'),
                                'tipo_solicitacao'  => $request->get('tipo_solicitacao'),
                                'apresentacao'      => $request->get('apresentacao'),
                                'forma_contacto'    => $request->get('forma_contacto'),
                                'ciclo_estudos'     => $request->get('ciclo_estudos'),
                                'curso'             => $request->get('curso'),
                                'genero'            => $request->get('genero'),
                                'faculdade'         => $request->get('faculdade'),
                                'follow_up'         => ($request->has('follow_up') ? 1 : 0)]);
            $a->save();

            EstadoSolicitacao::where('solicitacao_id', $request->get('solicitacao_id'))
                ->update([  'data_inicio'           => $request->get('data_inicio'),
                            'data_resposta'         => $request->get('data_resposta'),
                            'data_fecho_previsto'   => $request->get('data_fecho_previsto'),
                            'data_encerramento'     => $request->get('data_encerramento'),
                            'estado'                => $request->get('estado')]
                );
        }

        // Se a entrada já existe, atualizar os dados referentes a essa
        else{
            Analitica::where('solicitacao_id', $request->get('solicitacao_id'))
                ->update(['solicitacao_id'    => $request->get('solicitacao_id'),
                          'tipo_solicitacao'  => $request->get('tipo_solicitacao'),
                          'apresentacao'      => $request->get('apresentacao'),
                          'forma_contacto'    => $request->get('forma_contacto'),
                          'ciclo_estudos'     => $request->get('ciclo_estudos'),
                          'curso'             => $request->get('curso'),
                          'genero'            => $request->get('genero'),
                          'faculdade'         => $request->get('faculdade'),
                          'follow_up'         => ($request->has('follow_up') ? 1 : 0)]);

            EstadoSolicitacao::where('solicitacao_id', $request->get('solicitacao_id'))
                ->update([  'data_inicio'           => $request->get('data_inicio'),
                        'data_resposta'         => $request->get('data_resposta'),
                        'data_fecho_previsto'   => $request->get('data_fecho_previsto'),
                        'data_encerramento'     => $request->get('data_encerramento'),
                        'estado'                => $request->get('estado')]
                );
        }

        // ID da analítica correspondente a uma solicitação
        $id = Analitica::where('solicitacao_id', $request->get('solicitacao_id'))->first()->analitica_id;

        // Retrieve em todos os assuntos existentes, bem como os que estão guardados para esta solicitação
        $todosAssuntos = Assunto::all();
        $assuntosExistentes = AssuntoAnalitica::where('analitica_id', $id)->get();

        // Alterar as naturezas e assuntos:
        foreach ($todosAssuntos as $assunto) {
            // Assunto selecionado e não existe na base da dados == adicionar na base de dados
            if($request->has($assunto->assunto_id) and !$assuntosExistentes->contains('assunto_id', '=', $assunto->assunto_id)){
                $aa = new AssuntoAnalitica(['assunto_id' => $assunto->assunto_id, 'analitica_id' => $id]);
                $aa->save();
            }

            // Assunto não selecionado e existe na base de dados == remover da base de dados
            if(!$request->has($assunto->assunto_id) and $assuntosExistentes->contains('assunto_id', '=', $assunto->assunto_id)){
               AssuntoAnalitica::where('assunto_id', $assunto->assunto_id)
                   ->where('analitica_id', $id)
                   ->delete();
            }
        }

        return back()->with('sucesso', 'A analítica foi alterada com sucesso!');
    }

    /**
     * Devolver a view da página dos assuntos
     *
     * @return view('admin.assuntos')
     */
    public function showAssuntos(){
        $assunto = Assunto::paginate(15);
        return view('admin.assuntos', ['assunto' => $assunto]);
    }

    /**
     * Devolver a view da página das naturezas
     *
     * @return view('admin.naturezas')
     */
    public function showNaturezas(){
        $natureza = Natureza::paginate(15);
        return view('admin.naturezas', ['natureza' => $natureza]);
    }

    /**
     * Devolver a view da página de adição de naturezas
     *
     * @return view('components.natureza.adicionar-natureza')
     */
    public function showAddNatureza(){
        return view('components.natureza.adicionar-natureza');
    }

    /**
     * Método para adicionar uma natureza à base de dados
     *
     * @param Request $request
     * @return Confirmação da adição de natureza
     */
    public function confirmAddNatureza(Request $request){
        $atributos = ['descricao' => '<b>Tipo de Natureza</b>'];

        // Adicionar uma natureza à base de dados
        $validator = Validator::make($request->all(), [
            'descricao' => 'min:2|max:50|unique:natureza,descricao',
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $natureza = new Natureza(['descricao' => $request->get('descricao')]);
        $natureza->save();

        return back()->with('sucesso', 'Foi adicionada uma nova natureza!');
    }

    /**
     * Devolver a view da página de edição de naturezas
     *
     * @param Natureza $natureza
     * @return view('components.natureza.editar-natureza')
     */
    public function editNatureza(Natureza $natureza){
        return view('components.natureza.editar-natureza', ['natureza' => $natureza]);
    }

    /**
     * Método para atualizar uma natureza da base de dados
     *
     * @param Request $request
     * @return Confirmação da atualização de natureza
     */
    public function confirmEditNatureza(Request $request){

        $atributos = ['descricao' => '<b>Tipo de Natureza</b>'];
        $id = $request->get('natureza_id');

        // Adicionar uma natureza à base de dados
        $validator = Validator::make($request->all(), [
            'descricao'         =>  [
                'min:2',
                'max:50',
                Rule::unique('natureza')->ignore($id, 'natureza_id'),
            ]
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        Natureza::find($id)->update(['descricao' => $request->get('descricao')]);
        return back()->with('sucesso', 'O tipo de natureza foi editada!');

    }

    /**
     * Devolver a view da página de adição de assuntos
     *
     * @return view('components.assunto.adicionar-assunto')
     */
    public function showAddAssuntos(){
        $natureza = Natureza::all();
        return view('components.assunto.adicionar-assunto', ['natureza' => $natureza]);
    }

    /**
     * Devolver a view da página de edição de assuntos
     *
     * @param Assunto $assunto
     * @return view('components.assunto.editar-assunto')
     */
    public function editAssunto(Assunto $assunto){
        $natureza = Natureza::all();
        return view('components.assunto.editar-assunto', ['assunto' => $assunto, 'natureza' => $natureza]);
    }

    /**
     * Método para atualizar um assunto da base de dados
     *
     * @param Request $request
     * @return Confirmação da atualização de assunto
     */
    public function confirmEditAssunto(Request $request){
        $atributos = ['subcategoria' => '<b>Subcategoria</b>',
                        'descricao'  => '<b>Descrição do Assunto</b>'];

        $id = $request->get('assunto_id');

        $validator = Validator::make($request->all(), [
            'subcategoria' => [
                'min:2',
                'max:255',
                Rule::unique('assunto')->ignore($id, 'assunto_id')->where(
                    fn ($query) => $query->where('natureza_id', $request->get('natureza_id'))
                ),
            ],
            'descricao' => 'required'
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        Assunto::find($id)->update(['natureza_id'   => $request->get('natureza_id'),
                                    'subcategoria'  => $request->get('subcategoria'),
                                    'descricao'     => $request->get('descricao')]);

        return back()->with('sucesso', 'O assunto foi editado!');
    }
    /**
     * Método para adicionar um assunto na base de dados
     *
     * @param Request $request
     * @return Confirmação da adição de assunto
     */
    public function confirmAddAssuntos(Request $request){
        $atributos = ['subcategoria' => '<b>Subcategoria</b>',
                        'descricao'  => '<b>Descrição do Assunto</b>'];

        // Adicionar uma natureza à base de dados
        $validator = Validator::make($request->all(), [
            'subcategoria' => [
                'min:2',
                'max:255',
                Rule::unique('assunto')->where(
                    fn ($query) => $query->where('natureza_id', $request->get('natureza'))
                ),
            ],
            'descricao' => 'required'
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $assunto = new Assunto(['natureza_id'   => $request->get('natureza'),
                                'subcategoria'  => $request->get('subcategoria'),
                                'descricao'     => $request->get('descricao')]);
        $assunto->save();

        return back()->with('sucesso', 'Foi adicionada um novo assunto!');
    }

}
