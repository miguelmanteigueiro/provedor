<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosSolicitacao extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'anexos_solicitacao';
    public $timestamps = false;

    /**
     * Define uma relação entre AnexoSolicitação e Solicitação.
     * Um anexo pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class);
    }

}
