@props(['user'])

<tr>
    <td> {{ $user->id }} </td>
    <td> {{ $user->primeiro_nome }} </td>
    <td> {{ $user->ultimo_nome }} </td>
    <td> {{ $user->email }} </td>
    <td> {!! !empty($user->last_login) ? $user->last_login : "N/A" !!} </td>
    <td> {!! ($user->conta_ativa == 1) ? "Ativo" : "Desativada" !!} </td>
    <td> {!! ($user->administrador == 1) ? "Administrador" : "Utilizador" !!} </td>
    <td> <x-botao-tabela function="Editar Conta" id="{{ $user->id }}" /> </td>
    @if (Auth::user()->id != $user->id)
        @if (($user->conta_ativa == 1))
            <td> <x-botao-tabela function="Desativar Conta" id="{{ $user->id }}" /> </td>     
        @else
            <td> <x-botao-tabela function="Ativar Conta" id="{{ $user->id }}" /> </td>   
        @endif
    @endif
</tr>