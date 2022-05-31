<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Natureza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnaliticaController extends Controller
{
    public function view(){
        return view('admin.analitica');
    }

    public function showAssuntos(){
        $assunto = Assunto::paginate(15);
        return view('admin.assuntos', ['assunto' => $assunto]);
    }

    public function showNaturezas(){
        $natureza = Natureza::paginate(15);
        return view('admin.naturezas', ['natureza' => $natureza]);
    }

    public function showAddNatureza(){
        return view('components.natureza.adicionar-natureza');
    }

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

    public function editNatureza(Natureza $natureza){
        return view('components.natureza.editar-natureza', ['natureza' => $natureza]);
    }

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
    public function showAddAssuntos(){
        $natureza = Natureza::all();
        return view('components.assunto.adicionar-assunto', ['natureza' => $natureza]);
    }

    public function confirmAddAssuntos(Request $request){
        $atributos = ['subcategoria' => '<b>Subcategoria</b>',
                        'descricao'  => '<b>Descrição do Assunto</b>'];
    
        // Adicionar uma natureza à base de dados
        $validator = Validator::make($request->all(), [
            'subcategoria' => 'min:2|max:255|unique:assunto,subcategoria',
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
