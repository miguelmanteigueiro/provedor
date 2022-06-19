<?php

namespace App\Http\Controllers;

use App\Models\EstadoSolicitacao;
use DateTime;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('login.login');
    }

    public function auth()
    {
        // Validar as credenciais
        $credenciais = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Tentar autenticar o utilizador com base nas credenciais introduzidas, 
        // bem como guardar uma timestamp do login.
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'conta_ativa' => 1])){
            session()->regenerate();
            Auth::user()->last_login = new DateTime();
            Auth::user()->save();

            // Verificar se existem solicitações que passaram a data de encerramento e não foram encerradas
            $today = new DateTime();
            $today = $today->format('Y-m-d');
            
            // Verificar a existência de solicitações cuja data de encerramento 
            // seja inferior que a de hoje, e que o seu estado seja aberto.
            $estados = EstadoSolicitacao::whereDate('data_encerramento', '<=', $today)->where('estado', 'aberto');
            if($estados->count()){
                return redirect('dashboard')
                    ->with('login', "Bem-vindo, " . Auth::user()->nome . "!")
                    ->with('aviso', "Existem ". $estados->count() . " solicitações que passaram a data de encerramento e não foram encerradas.");
            }
            
            return redirect('dashboard')->with('login', "Bem-vindo, " . Auth::user()->nome . "!");
        }
        
        // Caso falhe a autenticação:
        return back()
            ->withInput($credenciais)
            ->withErrors(['email' => 'Falha na autenticação.']);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
