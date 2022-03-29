<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'assuntos';
    public $timestamps = false;

    /**
     * Define uma relação entre Assunto e SolicitacaoAssunto 
     * Um assunto pertence a várias solicitações
     */
    public function solicitacao_assunto(){
        return $this->hasMany(SolicitacaoAssunto::class);
    }

}
