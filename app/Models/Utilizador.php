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

    /**
     * Atributos que suportam mass assignment
     *
     * @var array<string, string, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * Define uma relação entre Utilizador e Solicitação 
     * Um utilizador pode ter várias solicitações
     */
    public function solicitacao(){
        return $this->hasMany(Solicitacao::class);
    }
}
