<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Capitalizar o nome do utilizador
     */
    public function setNomeAttribute($nome)
    {
        $this->attributes['nome'] = ucwords($nome);
    }

    /**
     * Utilizar uma função de Hash para a senha
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Define uma relação entre Utilizador e Solicitação.
     * Um utilizador pode ter várias solicitações
     */
    public function solicitacao(){
        return $this->hasMany(Solicitacao::class);
    }

    /**
     * Define uma relação entre Utilizador e InfoUtilizador.
     * Um utilizador tem apenas uma informação (ID, data de criação, superadmin, conta ativa e último login)
     */
    public function informacao(){
        return $this->hasOne(InfoUtilizador::class);
    }

    /**
     * Define uma relação entre Utilizador e Comentário.
     * Um utilizador pode fazer vários comentários.
     */
    public function comentario(){
        return $this->hasMany(Comentario::class);
    }
}
