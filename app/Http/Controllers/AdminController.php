<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;

class AdminController extends Controller
{
    /**
     * Devolver a view da página de gestão de utilizadores
     *
     * @return view('admin.contas')
     */
    public function view(){
        $users = User::paginate(15);
        return view('admin.contas', ['users' => $users]);
    }

    /**
     * Devolver a view da página de gestão de logs
     *
     * @return view('admin.logs')
     */
    public function showLogs(){
        $logs = Log::paginate(15);
        return view('components.admin.logs', ['logs' => $logs]);
    }

    /**
     * Devolver a view da página de edição de conta
     *
     * @return view('admin.editar')
     */
    public function showEdit(User $user){
        return view('admin.editar', ['user' => $user]);
    }

    /**
     * Método para tratar a edição de conta
     *
     * @param Request $request
     * @return Confirmação de edição de conta
     */
    public function confirmEdit(Request $request)
    {
        $id = $request->get('id');
        $user = User::find($id);

        $atributos = ['primeiro_nome'   => '<b>Nome</b>',
                      'ultimo_nome'     => '<b>Apelido</b>',
                      'email'           => '<b>Email</b>'];

        // Validar os dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'min:2|max:50',
            'ultimo_nome'   => 'min:2|max:50',
            'email'         =>  [
                'required',
                'confirmed',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id, 'id'),
            ]
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Proceder à verificação das permissões de administrador e sua alteração, se necessário
        if($user->administrador == 0){
            if($request->has('administrador')){
                User::where('id', $id)->update(['administrador' => 1]);
            }
        }

        if($user->administrador == 1){
            if(! $request->has('administrador')){
                User::where('id', $id)->update(['administrador' => 0]);
            }
        }

        // Proceder às alterações dos dados pessoais
        // Se o utilizador quiser alterar a senha, gerar uma nova senha aleatória
        if($request->has('resetPassword')){
            User::where('id', $id)->update($request->only('primeiro_nome', 'ultimo_nome', 'email'));
            $tempPassword = Random::generate(10);
            $user->password = $tempPassword;
            $user->save();

            return back()->with('senha_alterada', "Foram alterados os dados do funcionário $user->nome. A nova senha é: <h4>$tempPassword</h4>");
        }

        // Proceder às alterações dos dados pessoais
        // Se o utilizador não tiver alterado a senha, então não é necessário atualizar a senha
        else{
            User::where('id', $id)->update($request->only('primeiro_nome', 'ultimo_nome', 'email'));

            return back()->with('sucesso', 'Foram alterados os dados do funcionário ' . $user->nome);
        };
    }

    /**
     * Método para ativar uma conta
     *
     * @param User $user
     * @return Confirmação de ativação de conta
     */
    public function activate(User $user){
        User::find($user->id)->update(['conta_ativa' => 1]);
        return back()->with('sucesso', 'A conta foi reativada!');
    }

    /**
     * Método para desativar uma conta
     *
     * @param User $user
     * @return Confirmação de desativação de conta
     */
    public function deactivate(User $user){
        User::find($user->id)->update(['conta_ativa' => 0]);
        return back()->with('sucesso', 'A conta foi desativada!');
    }

    /**
     * Devolver a view da página de criação de conta
     *
     * @return view('admin.registar')
     */
    public function register()
    {
        return view('admin.registar');
    }

    /**
     * Método para tratar a criação de conta
     *
     * @param Request $request
     * @return Confirmação de criação de conta
     */
    public function store(Request $request)
    {
        $atributos = ['email'         => '<b>Endereço de Email</b>',
                      'primeiro_nome' => '<b>Nome</b>',
                      'ultimo_nome'   => '<b>Apelido</b>'];

        // Validar os dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'min:2|max:50',
            'ultimo_nome'   => 'min:2|max:50',
            'email'         => 'required|confirmed|email|unique:users,email|max:255',
        ], [], $atributos);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // Registar o utilizador
        // Utilizar uma senha aleatória
        $tempPassword = Random::generate(10);
        $user = new User(['primeiro_nome' => $request->get('primeiro_nome'), 'ultimo_nome' => $request->get('ultimo_nome'), 'email' => $request->get('email')]);
        $user->password = $tempPassword;
        $user->save();

        // Devolver a mensagem de confirmação com a senha temporária
        return back()->with('nova_conta', 'Foi registada uma nova conta! A senha temporária é: <h4>' . $tempPassword . '</h4>');
    }
}
