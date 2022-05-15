<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    
    public function show()
    {
        $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($q) {
                $q->where("estado", "aberto");
            })->paginate(15);

        return view('solicitacao.show', ['solicitacoes' => $solicitacoes]);
    }

    public function arquivo()
    {
        $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($q) {
            $q->where("estado", '!=', "aberto");
        })->paginate(15);

        return view('solicitacao.arquivo', ['solicitacoes' => $solicitacoes]);
    }
    
    public function definicoes()
    {
        return view('dashboard.definicoes');
    }

    public function changeName(Request $request)
    {
        $atributos = ['primeiro_nome' => '<b>Nome</b>',
                      'ultimo_nome' => '<b>Apelido</b>'];

        // Validar o nome
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'min:2|max:50',
            'ultimo_nome' => 'min:2|max:50',
        ], [], $atributos);
 
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        
        // Proceder à alteração do nome
        else{
            $id = Auth::user()->id;
            $user = User::find($id);

            $user->primeiro_nome = $request->get('primeiro_nome');
            $user->ultimo_nome = $request->get('ultimo_nome');

            User::where('id', $id)->update($request->except('_token'));
        };

        return redirect('/definicoes')->with('sucesso', 'O seu nome foi alterado com sucesso!');
    }

    public function changeEmail(Request $request)
    {
        $atributos = ['email' => '<b>Endereço de Email</b>'];

        // Validar o email
        $validator = Validator::make($request->all(), [
            'email' => 'required|confirmed|email|unique:users,email|max:255',
        ], [], $atributos);
 
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        
        // Proceder à alteração do email
        else{
            $id = Auth::user()->id;
            User::where('id', $id)->update($request->only('email'));
        };

        return redirect('/definicoes')->with('sucesso', 'O seu endereço de email foi alterado com sucesso!');
    }

    public function changePassword(Request $request)
    {
        $atributos = ['password' => '<b>Password</b>'];

        // Validar a password
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'confirmed', 'max:255', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [], $atributos);
 
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        
        // Proceder à alteração da password
        else{
            $id = Auth::user()->id;
            $user = User::find($id); 
            
            $user->setPasswordAttribute($request->get('password'));
            $user->save();
        };

        return redirect('/definicoes')->with('sucesso', 'A sua palavra-passe foi alterada com sucesso!');
    }
}
