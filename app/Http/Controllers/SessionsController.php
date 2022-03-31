<?php

namespace App\Http\Controllers;

use App\Models\Utilizador;

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
            'senha' => 'required',
        ]);

        // Tentar autenticar o utilizador com base
        // nas credenciais introduzidas
        if(auth()->attempt($credenciais)){
            session()->regenerate();
            return redirect('dashboard')->with('mensagem', 'Olá!');
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
