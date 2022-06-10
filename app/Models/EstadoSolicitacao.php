<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSolicitacao extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'estado_solicitacao';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Devolve o estado numa string legível
     *
     * @return string
     */
    public function getEstadoAttribute()
    {
        return ucwords($this->attributes['estado']);
    }

    /**
     * Define uma relação entre EstadoSolicitacao e Solicitação.
     * Um estado de solicitação pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id', 'solicitacao_id');
    }
}
