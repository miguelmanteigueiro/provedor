<?php

namespace App\Http\Controllers;

use App\Models\Utilizador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Caster\RedisCaster;

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
            'senha' => 'required|min:10|max:255',
        ]);

        Utilizador::create($atributos);

        session()->flash('contaRegistada', 'Conta registada com sucesso.');

        return redirect('/');
    }
}
