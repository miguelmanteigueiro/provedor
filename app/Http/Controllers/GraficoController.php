<?php

namespace App\Http\Controllers;

use App\Models\Natureza;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function showGraficos(){
        $naturezas = Natureza::all();
        return view('components.graficos.index-graficos', ['naturezas' => $naturezas]);
    }

    public function obterGrafico(Request $request){
        ddd($request);

        $naturezas = Natureza::all('descricao')->toArray();
        if($request->hasAny($naturezas)){
            $natureza = $request->except('_token');
            $nome = array_search('on', $natureza);
        }

        else{
            return back()->with('aviso', 'Deve selecionar uma natureza para gerar o respetivo gráfico!');
        }
    }
}
