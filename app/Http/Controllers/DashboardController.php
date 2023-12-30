<?php

namespace App\Http\Controllers;

use App\Models\EstadoSolicitacao;
use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{

    /**
     * Função para verificar se a string é uma data
     *
     * @param string $string
     * @return boolean
     */
    private function isDate($string)
    {
        return (bool)strtotime($string);
    }


    /**
     * Devolver o dashboard principal
     *
     * @return view('solicitacao.show')
     */
    public function show()
    {
        $searchTerm = request('search');
        $isDateSearch = $this->isDate($searchTerm);

        $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($q) {
            $q->where("estado", "aberto");
        });

        if ($searchTerm && !$isDateSearch) {
            $solicitacoes->where(function ($q) use ($searchTerm) {
                $q->where('referencia_interna', 'like', '%' . $searchTerm . '%')
                    ->orWhere('estudante_nome', 'like', '%' . $searchTerm . '%')
                    ->orWhere('estudante_email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($isDateSearch) {
            $solicitacoes->whereHas('estado_solicitacao', function ($q) use ($searchTerm) {
                $q->where('data_inicio', 'like', '%' . $searchTerm . '%');
            });
        }

        return view('solicitacao.show', ['solicitacoes' => $solicitacoes->paginate(15)]);
    }


    /**
     * Devolver o arquivo de solicitações
     *
     * @return view('solicitacao.arquivo')
     */
    public function arquivo()
    {
        $searchTerm = request('search');
        $isDateSearch = $this->isDate($searchTerm);

        $solicitacoes = Solicitacao::whereHas('estado_solicitacao', function ($q) {
            $q->where("estado", '!=', "aberto");
        });

        if ($searchTerm && !$isDateSearch) {
            $solicitacoes->where(function ($q) use ($searchTerm) {
                $q->where('referencia_interna', 'like', '%' . $searchTerm . '%')
                    ->orWhere('estudante_nome', 'like', '%' . $searchTerm . '%')
                    ->orWhere('estudante_email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($isDateSearch) {
            $solicitacoes->whereHas('estado_solicitacao', function ($q) use ($searchTerm) {
                $q->where('data_inicio', 'like', '%' . $searchTerm . '%');
            });
        }

        return view('solicitacao.arquivo', ['solicitacoes' => $solicitacoes->paginate(15)]);
    }

    /**
     * Devolver a view da página de definições
     *
     * @return view('dashboard.definicoes')
     */
    public function definicoes()
    {
        return view('dashboard.definicoes');
    }

    /**
     * Método para tratar a edição do nome do utilizador
     *
     * @param Request $request
     * @return Confirmação de edição do nome
     */
    public function changeName(Request $request)
    {
        $atributos = ['primeiro_nome'   => '<b>Nome</b>',
                      'ultimo_nome'     => '<b>Apelido</b>'];

        // Validar o nome
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'min:2|max:50',
            'ultimo_nome'   => 'min:2|max:50',
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

    /**
     * Método para tratar a edição do email do utilizador
     *
     * @param Request $request
     * @return Confirmação de edição do email
     */
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

    /**
     * Método para tratar a edição da password do utilizador
     *
     * @param Request $request
     * @return Confirmação de edição da password
     */
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
