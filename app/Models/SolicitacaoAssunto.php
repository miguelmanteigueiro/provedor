<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAssunto extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'solicitacao_assunto';
    public $timestamps = false;

    /**
     * Define uma relação entre SolicitacaoAssunto e Assunto.
     * Várias solicitações podem ter o mesmo assunto.
     */
    public function assunto(){
        return $this->belongsTo(Assunto::class);
    }

    /**
     * Define uma relação entre SolicitacaoAssunto e Solicitacao.
     * Vários assuntos podem estar em uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class);
    }
}
