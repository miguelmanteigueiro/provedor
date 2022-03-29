<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilizador extends Model
{
    use HasFactory;
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'utilizadores';
    public $timestamps = false;

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Utilizador::where('utilizador_id', $key);

        if ($obj->count() == 0)
            return null;

        $utilizador = $obj->first();
        return $utilizador;
    }

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
    public function setSenhaAttribute($senha)
    {
        $this->attributes['senha'] = bcrypt($senha);
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
