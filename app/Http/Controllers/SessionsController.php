<?php

namespace App\Http\Controllers;

use App\Models\Utilizador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    public function create()
    {
        return view('login.login');
    }

    public function store()
    {
        // Validar as credenciais
        $credenciais = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
                
        // Tentar autenticar o utilizador com base
        // nas credenciais introduzidas
        if(auth()->attempt($credenciais)){
            session()->regenerate();
            return redirect('dashboard')->with('mensagem', "Olá " . Auth::user()->nome);
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
