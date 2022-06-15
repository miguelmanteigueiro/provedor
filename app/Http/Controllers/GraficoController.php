<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\AssuntoAnalitica;
use App\Models\Natureza;
use App\Models\Solicitacao;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function showGraficos(){
        $naturezas = Natureza::all();
        return view('components.graficos.index-graficos', ['naturezas' => $naturezas]);
    }

    public function obterGrafico(Request $request){
        $naturezas = Natureza::all('descricao')->toArray();
        if($request->hasAny($naturezas)){
            $natureza = $request->except('_token');
            $nome = array_search('on', $natureza);
            return view('components.graficos.gerar-grafico',
                ['natureza' => Natureza::where('descricao', $nome)->first()]);
        }

        else{
            return back()->with('aviso', 'Deve selecionar uma natureza para gerar o respetivo gráfico!');
        }
    }

    public function obterGraficoFollowUp(){
        $solicitacao = Solicitacao::all();
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

    public function obterGraficoSituacaoTipologia(){
        $naturezas = Natureza::all();
        $solicitacoes = Solicitacao::all();
        return view('components.graficos.gerar-grafico-situacao-tipologia',
            ['naturezas' => $naturezas,
             'solicitacoes' => $solicitacoes]
        );
    }

    public function obterGraficoSituacaoCicloEstudos(){
        $naturezas = Natureza::all();
        $solicitacoes = Solicitacao::all();
        return view('components.graficos.gerar-grafico-situacao-cicloestudos',
            ['naturezas' => $naturezas,
             'solicitacoes' => $solicitacoes]
        );
    }
}
