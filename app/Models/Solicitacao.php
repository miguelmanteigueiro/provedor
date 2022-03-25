<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'solicitacoes';
    public $timestamps = false;
    
    /**
     * Define os Enums necessários para a DB e outras funcionalidades
     */
    public const SITUACAO_ACADEMICA = ['estudante', 'ex_estudante', 'candidato', 'outro'];

    /**
     * Atributos que suportam mass assignment
     *
     * @var array<string, string, string>
     */
    protected $fillable = [
        'situacao_academica',
        'estudante_id',
        'estudante_nome',
        'estudante_email',
        'estudante_telefone',
        'descricao'
    ];

    /**
     * Define uma relação entre Solicitação e Utilizador 
     * Uma solicitação apenas pertence a um utilizador
     */
    public function utilizador(){
        return $this->hasOne(Utilizador::class);
    }
}
