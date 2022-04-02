<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function register()
    {
        return view('admin.register');
    }

    public function store()
    {
        // Criar um utilizador na base de dados
        $atributos = request()->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:utilizadores,email|max:255',
            'password' => 'required|min:10|max:255',
        ]);

        User::create($atributos);

        return redirect('/')->with('sucesso', 'Conta registada com sucesso.');
    }
}
