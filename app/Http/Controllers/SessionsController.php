<?php

namespace App\Http\Controllers;

use App\Models\Utilizador;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Time;

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
        return redirect('/')->with('sucesso', 'Logout efetuado!');
    }
}
