<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class AdminController extends Controller
{
    public function view(){
        $users = User::paginate(15);
        return view('admin.contas', ['users' => $users]);
    }

    public function showEdit(User $user){
        return view('admin.editar', ['user' => $user]);
    }

    public function confirmEdit(Request $request){
        dd("OK");
    }

    public function activate(User $user){
        User::find($user->id)->update(['conta_ativa' => 1]);
        return back()->with('sucesso', 'A conta foi reativada!');
    }

    public function deactivate(User $user){
        User::find($user->id)->update(['conta_ativa' => 0]);
        return back()->with('sucesso', 'A conta foi desativada!');
    }

    public function register()
    {
        return view('admin.registar');
    }

    public function store(Request $request)
    {
        $atributos = ['email'         => '<b>Endereço de Email</b>',
                      'primeiro_nome' => '<b>Nome</b>',
                      'ultimo_nome'   => '<b>Apelido</b>'];
    
        // Criar um utilizador na base de dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'min:2|max:50',
            'ultimo_nome'   => 'min:2|max:50',
            'email'         => 'required|confirmed|email|unique:users,email|max:255',
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        $tempPassword = Random::generate(10);
        $user = new User(['primeiro_nome' => $request->get('primeiro_nome'), 'ultimo_nome' => $request->get('ultimo_nome'), 'email' => $request->get('email')]);
        $user->password = $tempPassword;
        $user->save();

        return back()->with('nova_conta', 'Foi registada uma nova conta! A senha temporária é: <h4>' . $tempPassword . '</h4>');
    }
}
