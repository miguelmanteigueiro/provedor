<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\AssuntoAnalitica;
use App\Models\Natureza;
use App\Models\Solicitacao;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    /**
     * Devolver a página para gerar gráficos
     *
     * @return view('components.graficos.index-graficos')
     */
    public function showGraficos(){
        $naturezas = Natureza::all();
        return view('components.graficos.index-graficos', ['naturezas' => $naturezas]);
    }

    /**
     * Método para gerar o gráfico de barras para uma determinada natureza
     *
     * @param Request $request
     * @return view('components.graficos.grafico-barras')
     */
    public function obterGrafico(Request $request){
        $naturezas = Natureza::all('descricao')->toArray();
        $search_array = $naturezas;

        // Substituir todos os espaços por underscores
        // Guardar o resultado num array auxiliar
        foreach ($naturezas as $key => $value) {
            $search_array[$key] = str_replace(' ', '_', $value);
        }

        if($request->hasAny($search_array)){
            $request_params = $request->except('_token');
            $nome = array_search('on', $request_params);
            // Trocar os underscores por espaços
            $nome = str_replace('_', ' ', $nome);

            // Verificar as datas introduzidas
            if($request->has('data_inicio') and $request->has('data_fim')) {
                // Verificar se as datas não são vazias
                if ($request->get('data_inicio') != null and $request->get('data_fim') != null) {
                    // Por fim, verificar se a data inicial é menor que a data final
                    if (strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                        return view('components.graficos.gerar-grafico',
                            ['natureza' => Natureza::where('descricao', $nome)->first(),
                             'data_inicio' => $request->get('data_inicio'),
                             'data_fim' => $request->get('data_fim')]
                        );
                    }

                    else {
                        return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                    }
                }
            }
            return view('components.graficos.gerar-grafico',
                ['natureza' => Natureza::where('descricao', $nome)->first()]);
        }

        else{
            return back()->with('aviso', 'Deve selecionar uma natureza para gerar o respetivo gráfico!');
        }
    }

    /**
     * Método para gerar o gráfico circular para o follow-up
     *
     * @param Request $request
     * @return view('components.graficos.gerar-grafico-follow-up')
     */
    public function obterGraficoFollowUp(Request $request){
        // Verificar as datas introduzidas
        if($request->has('data_inicio') and $request->has('data_fim')){
            // Verificar se as datas não são vazias
            if($request->get('data_inicio') != null and $request->get('data_fim') != null){
                // Por fim, verificar se a data inicial é menor que a data final
                if(strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                    // Selecionar as solicitações que se encontram entre as datas
                   $solicitacao = Solicitacao::whereHas('estado_solicitacao', function ($query) use ($request) {
                        $query->where('data_inicio', '>=', $request->get('data_inicio'))
                            ->where('data_inicio', '<=', $request->get('data_fim'));
                    })->get();
                }
                else{
                    return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                }
            }
        }
        // Se não foram introduzidas datas, selecionar todas as solicitações
        isset($solicitacao) ? $solicitacao : $solicitacao = Solicitacao::all();

        if($solicitacao->count()){
            $follow_up_sim = 0;
            $follow_up_nao = 0;
            foreach ($solicitacao as $solicitacao){
                if($solicitacao->analitica){ // Verificar se existe analítica já inserida na base de dados
                    if($solicitacao->analitica->follow_up == 1){ // Verificar se existiu follow-up
                        $follow_up_sim++;
                    }
                    else{
                        $follow_up_nao++;
                    }
                }
                else{
                    $follow_up_nao++;
                }
            }

            return view('components.graficos.gerar-grafico-follow-up',
                ['follow_up_sim' => $follow_up_sim,
                 'follow_up_nao' => $follow_up_nao]
            );
        }
        else{
            return back()->with('aviso', 'Não existem solicitações para gerar o gráfico!');
        }

    }

    /**
     * Método para gerar o gráfico combinado com a natureza/tipologia
     *
     * @param Request $request
     * @return view('components.graficos.gerar-grafico-situacao-tipologia')
     */
    public function obterGraficoSituacaoTipologia(Request $request){
        // Verificar as datas introduzidas
        if($request->has('data_inicio') and $request->has('data_fim')){
            // Verificar se as datas não são vazias
            if($request->get('data_inicio') != null and $request->get('data_fim') != null){
                // Por fim, verificar se a data inicial é menor que a data final
                if(strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                    // Selecionar as solicitações que se encontram entre as datas
                    $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($query) use ($request) {
                        $query->where('data_inicio', '>=', $request->get('data_inicio'))
                            ->where('data_inicio', '<=', $request->get('data_fim'));
                    })->get();
                }
                else{
                    return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                }
            }
        }
        // Se não foram introduzidas datas, selecionar todas as solicitações
        isset($solicitacoes) ? $solicitacoes : $solicitacoes = Solicitacao::all();
        $naturezas = Natureza::all();

        if($solicitacoes->count()) {
            return view('components.graficos.gerar-grafico-situacao-tipologia',
                ['naturezas' => $naturezas,
                 'solicitacoes' => $solicitacoes]
            );
        }
        else{
            return back()->with('aviso', 'Não existem solicitações para gerar o gráfico!');
        }
    }

    /**
     * Método para gerar o gráfico combinado com a natureza/ciclo de estudos
     *
     * @param Request $request
     * @return view('components.graficos.gerar-grafico-situacao-cicloestudos')
     */
    public function obterGraficoSituacaoCicloEstudos(Request $request){
        // Verificar as datas introduzidas
        if($request->has('data_inicio') and $request->has('data_fim')){
            // Verificar se as datas não são vazias
            if($request->get('data_inicio') != null and $request->get('data_fim') != null){
                // Por fim, verificar se a data inicial é menor que a data final
                if(strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                    // Selecionar as solicitações que se encontram entre as datas
                    $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($query) use ($request) {
                        $query->where('data_inicio', '>=', $request->get('data_inicio'))
                            ->where('data_inicio', '<=', $request->get('data_fim'));
                    })->get();
                }
                else{
                    return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                }
            }
        }
        // Se não foram introduzidas datas, selecionar todas as solicitações
        isset($solicitacoes) ? $solicitacoes : $solicitacoes = Solicitacao::all();
        $naturezas = Natureza::all();

        if($solicitacoes->count()){
            return view('components.graficos.gerar-grafico-situacao-cicloestudos',
                ['naturezas' => $naturezas,
                 'solicitacoes' => $solicitacoes]
            );
        }
        else{
            return back()->with('aviso', 'Não existem solicitações para gerar o gráfico!');
        }
    }

    public function obterGraficoSituacaoFaculdade(Request $request){
        // Verificar as datas introduzidas
        if($request->has('data_inicio') and $request->has('data_fim')){
            // Verificar se as datas não são vazias
            if($request->get('data_inicio') != null and $request->get('data_fim') != null){
                // Por fim, verificar se a data inicial é menor que a data final
                if(strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                    // Selecionar as solicitações que se encontram entre as datas
                    $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($query) use ($request) {
                        $query->where('data_inicio', '>=', $request->get('data_inicio'))
                            ->where('data_inicio', '<=', $request->get('data_fim'));
                    })->get();
                }
                else{
                    return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                }
            }
        }
        // Se não foram introduzidas datas, selecionar todas as solicitações
        isset($solicitacoes) ? $solicitacoes : $solicitacoes = Solicitacao::all();
        $naturezas = Natureza::all();

        if($solicitacoes->count()){
            return view('components.graficos.gerar-grafico-situacao-faculdade',
                ['naturezas' => $naturezas,
                 'solicitacoes' => $solicitacoes]
            );
        }
        else{
            return back()->with('aviso', 'Não existem solicitações para gerar o gráfico!');
        }
    }

    public function obterGraficoSituacaoGenero(Request $request){
        // Verificar as datas introduzidas
        if($request->has('data_inicio') and $request->has('data_fim')){
            // Verificar se as datas não são vazias
            if($request->get('data_inicio') != null and $request->get('data_fim') != null){
                // Por fim, verificar se a data inicial é menor que a data final
                if(strtotime($request->get('data_inicio')) <= strtotime($request->get('data_fim'))) {
                    // Selecionar as solicitações que se encontram entre as datas
                    $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($query) use ($request) {
                        $query->where('data_inicio', '>=', $request->get('data_inicio'))
                            ->where('data_inicio', '<=', $request->get('data_fim'));
                    })->get();
                }
                else{
                    return back()->with('aviso', 'Para efetuar a filtragem, a data inicial deve ser menor que a data final.');
                }
            }
        }
        // Se não foram introduzidas datas, selecionar todas as solicitações
        isset($solicitacoes) ? $solicitacoes : $solicitacoes = Solicitacao::all();
        $naturezas = Natureza::all();

        if($solicitacoes->count()){
            return view('components.graficos.gerar-grafico-situacao-genero',
                ['naturezas' => $naturezas,
                 'solicitacoes' => $solicitacoes]
            );
        }
        else{
            return back()->with('aviso', 'Não existem solicitações para gerar o gráfico!');
        }
    }
}
